<?php

namespace App\Http\Controllers;

use App\SyriansReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyriansReportController extends Controller
{
    /**
     * Returns an array of the total for each governorate in a givern year
     * with the gov. id and locale name.
     *
     * @return \Illuminate\Http\Response
     */
    public function map($year)
    {
        if (request()->header('Content-Language') === 'ar') {
            $governorate = 'name_ar';
        } else {
            $governorate = 'name_en';
        }

        $totals = DB::table('syrians_reports')
                        ->whereYear('date', '=', $year)
                        ->leftJoin('governorates', 'governorates.id', '=', 'syrians_reports.governorate_id')
                        ->select(
                            DB::raw("$governorate AS name"),
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15 +
                                        pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                        AS INTEGER)
                                    AS 'total'"),
                            DB::raw("CAST(
                                        SUM(males_under_5 + males_from_5_to_15 + females_under_5 + females_from_5_to_15)
                                        AS INTEGER)
                                    AS 'total_kids'"),
                            'map_key'
                            )
                        ->groupBy(['governorate_id', 'name_en', 'name_ar', 'map_key'])
                        ->get();

        return $totals;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SyriansReport  $syriansReport
     * @return \Illuminate\Http\Response
     */
    public function show(SyriansReport $syriansReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SyriansReport  $syriansReport
     * @return \Illuminate\Http\Response
     */
    public function edit(SyriansReport $syriansReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SyriansReport  $syriansReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SyriansReport $syriansReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SyriansReport  $syriansReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(SyriansReport $syriansReport)
    {
        //
    }
}
