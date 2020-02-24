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
    return redirect()->route('home');
})->name('index');

Route::get('home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
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

    // Charts
    Route::prefix('charts')->group(function () {
        Route::get('governorates', function () {
            return view('charts.governorates');
        })->name('charts.governorates');

        Route::get('countries', function () {
            return view('charts.countries');
        })->name('charts.countries');
    });

    // Map
    Route::get('map', function () {
        return view('map');
    })->name('map');
});