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

Route::group(['namespace' => 'ATPGroup\Emergencies\Controllers\Admin', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::get('emergency/activated/{emergency}', 'EmergencyController@activated')->name('emergency.activated');
    Route::resource('emergency', 'EmergencyController')->except(['show']);
    Route::get('emergencyRequest', 'EmergencyRequestController@index')->name('emergencyRequest.index');
    Route::delete('emergencyRequest/{emergencyRequest}', 'EmergencyRequestController@destroy')->name('emergencyRequest.destroy');
});

/*
|--------------------------------------------------------------------------
| API Routes Auth
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['namespace' => 'ATPGroup\Emergencies\Controllers\API', 'prefix' => '/api/emergency', 'middleware' => ['auth:api', 'set.api.locale']], function () {
    Route::get('', 'EmergencyController@getEmergencies');
    Route::post('request', 'EmergencyController@postEmergencyRequest');
});
