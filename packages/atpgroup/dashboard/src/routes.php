<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'ATPGroup\Dashboard\Controllers', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('dashboard/clearAdminCache', 'DashboardController@clearAdminCache')->name('dashboard.clearAdminCache');
    Route::get('dashboard/clearCompanyCache', 'DashboardController@clearCompanyCache')->name('dashboard.clearCompanyCache');
});
