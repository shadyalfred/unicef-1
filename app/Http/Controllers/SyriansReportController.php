<?php

namespace App\Http\Controllers;

use App\Governorate;
use App\SyriansReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyriansReportController extends Controller
{
    public function getTotalsForRange($from, $to)
    {
        if (request()->header('Content-Language') === 'ar') {
            $governorate = 'name_ar';
        } else {
            $governorate = 'name_en';
        }

        $totals = DB::table('syrians_reports')
                        ->whereBetween('date', [$from, $to])
                        ->leftJoin('governorates', 'governorates.id', '=', 'syrians_reports.governorate_id')
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

        $totals = DB::table('syrians_reports')
                        ->whereBetween('date', [$from, $to])
                        ->leftJoin('governorates', 'governorates.id', '=', 'syrians_reports.governorate_id')
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
 
        $totals = DB::table('syrians_reports')
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
        $totals = DB::table('syrians_reports')
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

        $totals = DB::table('syrians_reports')
                        ->whereYear('date', '=', $year)
                        ->leftJoin('governorates', 'governorates.id', '=', 'syrians_reports.governorate_id')
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

        $totals = DB::table('syrians_reports')
                        ->whereBetween('date', [$from, $to])
                        ->leftJoin('governorates', 'governorates.id', '=', 'syrians_reports.governorate_id')
                        ->select(
                            DB::raw("$governorate AS name"),
                            DB::raw("CAST(
                                        SUM(males_above_15_visits + males_under_5 + males_from_5_to_15 +
                                        pregnancy_visits + endangered_pregnancies +
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
        $syriansReports = SyriansReport::latest('id')->get();

        return view('reports.index.syrians', [
            'syriansReports' => $syriansReports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::all();

        return view('reports.create.syrian', [
            'governorates' => $governorates,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'governorate_id'         => 'required',
            'males_under_5'          => 'required|numeric',
            'males_from_5_to_15'     => 'required|numeric',
            'females_under_5'        => 'required|numeric',
            'females_from_5_to_15'   => 'required|numeric',
            'pregnancy_visits'       => 'required|numeric',
            'endangered_pregnancies' => 'required|numeric',
            'other_visits'           => 'required|numeric',
            'males_above_15_visits'  => 'required|numeric',
            'date'                   => 'required',
        ]);

        SyriansReport::create($validatedData);
        $governorate = Governorate::find($validatedData['governorate_id']);
        $governorate = app()->getLocale() === 'en' ? $governorate->name_en : $governorate->name_ar;

        $successMessage = __('A new record was added to the governorate of ') . $governorate;

        return back()->with('success', $successMessage);
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
        $governorates = Governorate::all();

        return view('reports.edit.syrians', [
            'governorates' => $governorates,
            'report' => $syriansReport,
        ]);
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
        $validatedData = $request->validate([
            'governorate_id'         => 'required',
            'males_under_5'          => 'required|numeric',
            'males_from_5_to_15'     => 'required|numeric',
            'females_under_5'        => 'required|numeric',
            'females_from_5_to_15'   => 'required|numeric',
            'pregnancy_visits'       => 'required|numeric',
            'endangered_pregnancies' => 'required|numeric',
            'other_visits'           => 'required|numeric',
            'males_above_15_visits'  => 'required|numeric',
            'date'                   => 'required',
        ]);

        $syriansReport->update($validatedData);

        return back()->with('success', __('Record was updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SyriansReport  $syriansReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(SyriansReport $syriansReport)
    {
        $syriansReport->delete();

        return back()->with('success', __('Record was deleted!'));
    }
}
