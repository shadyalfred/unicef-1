<?php

use App\CountryReport;
use App\SyriansReport;
use App\GovernorateReport;
use Illuminate\Http\Request;
use App\Http\Resources\ReportCollection;
use App\Http\Resources\SyriansReportCollection;
use App\Http\Resources\CountriesReportsCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Table
Route::get('reports-of-all-syrians', function () {
    return new SyriansReportCollection(SyriansReport::all());
})->name('getAllSyriansReports');

Route::get('reports-of-all-governorates', function () {
    return new ReportCollection(GovernorateReport::all());
})->name('getAllGovernoratesReports');

Route::get('reports-of-all-countries', function () {
    return new CountriesReportsCollection(CountryReport::all());
})->name('getAllCountriesReports');
// End Table

// Charts
Route::get('get-monthly-totals-for-governorates/{year}', 'GovernorateReportController@getTotalPerMonth')
    ->name('getTotalsForGovernoratesPerEachMonth');

Route::get('get-monthly-totals-for-nationalities/{year}', 'CountryReportController@getTotalPerMonth')
    ->name('getTotalsForNationalitiesPerEachMonth');

Route::get('get-total-of-males-and-females-for-governorates/{year}', 'GovernorateReportController@getTotalMalesFemales')
    ->name('getTotalGovernoratesMalesFemales');

Route::get('get-total-of-males-and-females-for-nationalities/{year}', 'CountryReportController@getTotalMalesFemales')
    ->name('getTotalNationalitiesMalesFemales');

Route::prefix('get-totals-for-each-governorate')->group(function () {
    Route::get('{year}', 'GovernorateReportController@getTotalsForEach')
        ->name('getTotalsForGovernorate');
});

Route::prefix('get-totals-for-each-nationality')->group(function () {
    Route::get('{year}', 'CountryReportController@getTotalsForEach')
        ->name('getTotalsForNationality');
});
// End Charts

// Maps
Route::get('syrians-map/{year}', 'SyriansReportController@map')
    ->name('syriansMapApi');

Route::get('governorates-map/{year}', 'GovernorateReportController@map')
    ->name('allNationalitiesMapApi');
// End Maps