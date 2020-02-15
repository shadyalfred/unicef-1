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

Route::get('/', function () {
    return view('welcome');
})->name('index');

// Authentication routes
Route::Auth(['verify' => true]);

Route::get('home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('test', function () {
    return view('test');
});

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

// Excel import test
Route::get('import', 'ExcelImportController@showForm')->name('excel.form');
Route::post('import', 'ExcelImportController@import')->name('excel.import');

// Reports Tables
Route::get('reports/syria', function () {
    return view('reports.syria');
});

Route::get('reports/all-nationalities', function () {
    return view('reports.table');
});