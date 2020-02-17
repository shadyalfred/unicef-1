<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CountryReportsImport;
use App\Imports\GovernorateReportsImport;

class ExcelImportController extends Controller
{
    // Governorates
    public function showGovernorateForm()
    {
        return view('import.governorate');
    }

    public function importGovernorate(Request $request)
    {
        Excel::import(new GovernorateReportsImport, $request->file('spreadsheet_file'));

        return back()->withSuccess('File was imported successfully!');
    }

    // Countries
    public function showCountryForm()
    {
        return view('import.country');
    }

    public function importCountry(Request $request)
    {
        Excel::import(new CountryReportsImport, $request->file('spreadsheet_file'));

        return back()->withSuccess('File was imported successfully!');
    }

}
