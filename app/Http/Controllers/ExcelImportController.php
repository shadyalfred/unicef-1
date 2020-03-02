<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SyriansReportImport;
use App\Imports\CountryReportsImport;
use App\Imports\GovernorateReportImport;

class ExcelImportController extends Controller
{
    // Governorates
    public function showGovernorateForm()
    {
        return view('import.governorate');
    }

    public function importGovernorate(Request $request)
    {
        // try {
            Excel::import(new GovernorateReportImport, $request->file('spreadsheet_file'));
            Excel::import(new SyriansReportImport, $request->file('spreadsheet_file'));
            return back()->withSuccess(__('File was imported successfully!'));
        // } catch (\Throwable $th) {
        //     return back()->withErrors(['error' => __('Something went wrong, please make sure you chose the correct file.')]);
        // }
    }

    // Countries
    public function showCountryForm()
    {
        return view('import.country');
    }

    public function importCountry(Request $request)
    {
        Excel::import(new CountryReportsImport, $request->file('spreadsheet_file'));

        return back()->withSuccess(__('File was imported successfully!'));
    }
}
