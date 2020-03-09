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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Password Confirmation Routes...
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

Route::get('/', function () {
    return redirect()->route('home');
})->name('index');

Route::get('home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::middleware('can:create-user')->group(function () {
    Route::get('user', 'UserController@create')->name('user.create');
    Route::post('user', 'UserController@store')->name('user.store');
});

Route::middleware('auth')->group(function () {
    // Show Profile
    Route::get('user/{user}', 'UserController@show')
        ->name('user.show')->middleware('can:view-profile,user');
    
    // Update Profile
    Route::put('user/{user}', 'UserController@update')
        ->name('user.update')->middleware('can:view-profile,user');

    // Edit Profile
    Route::get('user/{user}/edit', 'UserController@edit')
        ->name('user.edit')->middleware('can:view-profile,user');

    // Add new governorate
    Route::get('add/governorate', 'GovernorateController@create')
        ->name('governorate.add.showForm');

    Route::post('add/governorate', 'GovernorateController@store')
        ->name('governorate.add.submit');

    // Excel import
        // Governorates
        Route::get('import/governorate', 'ExcelImportController@showGovernorateForm')->name('import.governorate.form');
        Route::post('import/governorate', 'ExcelImportController@importGovernorate')->name('import.governorate.import');

        // Countries
        Route::get('import/country', 'ExcelImportController@showCountryForm')->name('import.country.form');
        Route::post('import/country', 'ExcelImportController@importCountry')->name('import.country.import');

    // Reports Tables
    Route::get('reports/syrians', function () {
        return view('reports.syrians');
    })->name('reports.syrians');

    Route::get('reports/governorates', function () {
        return view('reports.governorates');
    })->name('reports.governorates');

    Route::get('reports/countries', function () {
        return view('reports.countries');
    })->name('reports.countries');

    // Charts
    Route::prefix('charts')->group(function () {
        Route::get('syrians', function () {
            return view('charts.syrians');
        })->name('charts.syrians');
        
        Route::get('governorates', function () {
            return view('charts.governorates');
        })->name('charts.governorates');

        Route::get('countries', function () {
            return view('charts.countries');
        })->name('charts.countries');
    });

    // Maps
    Route::get('map/syrians', function () {
        return view('maps.syrians');
    })->name('map.syrians');
    Route::get('map/all-nationalities', function () {
        return view('maps.all-nationalities');
    })->name('map.allNationalities');
});
