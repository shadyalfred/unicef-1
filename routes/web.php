<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Switch App Locale
Route::get('switchLocale', function () {
    $locale = app()->getLocale() === 'en' ? 'ar' : 'en';

    if ($user = auth()->user()) {
        $user->locale = $locale;
        $user->save();
    } else {
        session(['locale' => $locale]);
    }

    return back();
})->name('switchLocale');

// Authentication routes
Route::Auth(['verify' => true]);

Route::get('/', function () {
    redirect()->route('home');
})->name('index');

Route::get('home', function () {
    redirect()->route('reports.governorates');
})->middleware('auth')->name('home');

// Excel import test
    // Governorates
    Route::get('import/governorate', 'ExcelImportController@showGovernorateForm')->name('import.governorate.form');
    Route::post('import/governorate', 'ExcelImportController@importGovernorate')->name('import.governorate.import');

    // Countries
    Route::get('import/country', 'ExcelImportController@showCountryForm')->name('import.country.form');
    Route::post('import/country', 'ExcelImportController@importCountry')->name('import.country.import');

// Reports Tables
Route::get('reports/governorates', function () {
    return view('reports.governorates');
})->name('reports.governorates');

Route::get('reports/countries', function () {
    return view('reports.countries');
})->name('reports.countries');
