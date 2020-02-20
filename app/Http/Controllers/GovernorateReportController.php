<?php

namespace App\Http\Controllers;

use App\GovernorateReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GovernorateReportController extends Controller
{
    /**
     * Returns an array of the total of each month for a given year.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTotalPerMonth($year)
    {
        $data = [null, null, null, null, null, null, null, null, null, null, null, null];  
 
        $totals = DB::table('governorate_reports')
                        ->whereYear('date', '=', $year)
                        ->orderBy('date')
                        ->select(
                            DB::raw("SUM(pregnancy_visits + endangered_pregnancies +
                                        other_visits + males_under_5 + males_from_5_to_15 +
                                        females_under_5 + females_from_5_to_15 + males_above_15_visits)
                                     AS total"),
                            DB::raw("DATE_FORMAT(date, '%m') AS month")
                            )
                        ->groupBy(['month', 'date'])
                        ->get();

        foreach ($totals as $total) {
            $data[$total->month - 1] = $total->total;
        }

        return response()->json($data);
    }

    /**
     * Returns an array of the total of males and females for a given year.
     * example: [males_total, females_total]
     *
     * @return \Illuminate\Http\Response
     */
    public function getTotalMalesFemales($year)
    {
        $totals = DB::table('governorate_reports')
                        ->whereYear('date', '=', $year)
                        ->select(
                            DB::raw("SUM(males_above_15_visits + males_under_5 + males_from_5_to_15)
                                     AS males"),
                            DB::raw("SUM(pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                     AS females")
                            )
                        ->get();

        return response()->json([$totals[0]->males, $totals[0]->females]);
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
     * @param  \App\GorvernorateReport  $gorvernorateReport
     * @return \Illuminate\Http\Response
     */
    public function show(GorvernorateReport $gorvernorateReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GorvernorateReport  $gorvernorateReport
     * @return \Illuminate\Http\Response
     */
    public function edit(GorvernorateReport $gorvernorateReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GorvernorateReport  $gorvernorateReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GorvernorateReport $gorvernorateReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GorvernorateReport  $gorvernorateReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(GorvernorateReport $gorvernorateReport)
    {
        //
    }
}
