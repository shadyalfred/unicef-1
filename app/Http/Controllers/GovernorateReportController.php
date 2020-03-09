<?php

namespace App\Http\Controllers;

use App\Governorate;
use App\GovernorateReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GovernorateReportController extends Controller
{
    public function getTotalsForRange($from, $to)
    {
        if (request()->header('Content-Language') === 'ar') {
            $governorate = 'name_ar';
        } else {
            $governorate = 'name_en';
        }

        $totals = DB::table('governorate_reports')
                        ->whereBetween('date', [$from, $to])
                        ->leftJoin('governorates', 'governorates.id', '=', 'governorate_reports.governorate_id')
                        ->select(
                            DB::raw("$governorate AS governorate"),
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15 +
                                        pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                    AS UNSIGNED
                                    ) AS 'total'"),
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15)
                                        AS UNSIGNED)
                                     AS 'males'"),
                            DB::raw("CAST(
                                        SUM(pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                        AS UNSIGNED)
                                     AS 'females'")
                            )
                        ->groupBy(['governorate_id', 'name_en', 'name_ar'])
                        ->orderByDesc('total')
                        ->get();

        return $totals;
    }

    public function getTotalKidsForRange($from, $to)
    {
        if (request()->header('Content-Language') === 'ar') {
            $governorate = 'name_ar';
        } else {
            $governorate = 'name_en';
        }

        $totals = DB::table('governorate_reports')
                        ->whereBetween('date', [$from, $to])
                        ->leftJoin('governorates', 'governorates.id', '=', 'governorate_reports.governorate_id')
                        ->select(
                            DB::raw("$governorate AS governorate"),
                            DB::raw("CAST(
                                        SUM(males_under_5 + males_from_5_to_15 +
                                        females_under_5 + females_from_5_to_15)
                                    AS UNSIGNED
                                    ) AS 'total'"),
                            DB::raw("CAST(
                                        SUM(males_under_5 + males_from_5_to_15)
                                        AS UNSIGNED)
                                     AS 'males'"),
                            DB::raw("CAST(
                                        SUM(females_under_5 + females_from_5_to_15)
                                        AS UNSIGNED)
                                     AS 'females'")
                            )
                        ->groupBy(['governorate_id', 'name_en', 'name_ar'])
                        ->orderByDesc('total')
                        ->get();

        return $totals;
    }

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
                            DB::raw("CAST(
                                        SUM(pregnancy_visits + endangered_pregnancies +
                                        other_visits + males_under_5 + males_from_5_to_15 +
                                        females_under_5 + females_from_5_to_15 + males_above_15_visits)
                                        AS UNSIGNED)
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
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15)
                                        AS UNSIGNED)
                                     AS males"),
                            DB::raw("CAST(
                                        SUM(pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                        AS UNSIGNED)
                                     AS females")
                            )
                        ->get();

        return response()->json([$totals[0]->males, $totals[0]->females]);
    }

    /**
     * Returns an array of the total, and total males,
     * and females for each governorate in a givern year.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTotalsForEach($year)
    {
        if (request()->header('Content-Language') === 'ar') {
            $governorate = 'name_ar';
        } else {
            $governorate = 'name_en';
        }

        $totals = DB::table('governorate_reports')
                        ->whereYear('date', '=', $year)
                        ->leftJoin('governorates', 'governorates.id', '=', 'governorate_reports.governorate_id')
                        ->select(
                            DB::raw("$governorate AS governorate"),
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15 +
                                        pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                    AS UNSIGNED
                                    ) AS 'total'"),
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15)
                                        AS UNSIGNED)
                                     AS 'males'"),
                            DB::raw("CAST(
                                        SUM(pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                        AS UNSIGNED)
                                     AS 'females'")
                            )
                        ->groupBy(['governorate_id', 'name_en', 'name_ar'])
                        ->orderByDesc('total')
                        ->get();

        return $totals;
    }

    /**
     * Returns an array of the total for each governorate for a given period of date
     * with the gov. id and locale name.
     *
     * @return \Illuminate\Http\Response
     */
    public function map($from, $to)
    {
        if (request()->header('Content-Language') === 'ar') {
            $governorate = 'name_ar';
        } else {
            $governorate = 'name_en';
        }

        $totals = DB::table('governorate_reports')
                        ->whereBetween('date', [$from, $to])
                        ->leftJoin('governorates', 'governorates.id', '=', 'governorate_reports.governorate_id')
                        ->select(
                            DB::raw("$governorate AS name"),
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15
                                        + pregnancy_visits + endangered_pregnancies +
                                        other_visits + females_under_5 + females_from_5_to_15)
                                        AS UNSIGNED)
                                    AS 'total'"),
                            DB::raw("CAST(
                                        SUM(males_under_5 + males_from_5_to_15 + females_under_5 + females_from_5_to_15)
                                        AS UNSIGNED)
                                    AS 'total_kids'"),
                            'map_key'
                            )
                        ->groupBy(['governorate_id', 'name_en', 'name_ar', 'map_key'])
                        ->orderByDesc('total')
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
