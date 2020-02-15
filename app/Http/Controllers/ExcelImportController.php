<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GovernorateReportsImport;

class ExcelImportController extends Controller
{
    public function showForm()
    {
        return view('excel.import');
    }

    public function import(Request $request)
    {
        Excel::import(new GovernorateReportsImport, $request->file('spreadsheet_file'));
        
        return back()->withSuccess('File was imported successfully!');
    }
}
