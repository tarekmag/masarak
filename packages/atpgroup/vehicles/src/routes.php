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

Route::group(['namespace' => 'ATPGroup\Vehicles\Controllers', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::get('vehicle/activated/{vehicle}', 'VehicleController@activated')->name('vehicle.activated');
    Route::resource('vehicle', 'VehicleController')->except(['show']);

    Route::get('vehicleDocument/print/{vehicleDocument}', 'VehicleDocumentController@print')->name('vehicleDocument.print');
    Route::resource('vehicleDocument', 'VehicleDocumentController')->except(['show']);
});
