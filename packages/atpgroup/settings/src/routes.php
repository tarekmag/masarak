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

Route::group(['namespace' => 'ATPGroup\Settings\Controllers\Admin', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::get('setting', 'SettingController@index')->name('setting.index');
    Route::post('setting', 'SettingController@update')->name('setting.update');
});

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

Route::group(['namespace' => 'ATPGroup\Settings\Controllers\API', 'prefix' => '/api/settings', 'middleware' => ['set.api.locale']], function () {
    Route::get('lookup', 'SettingController@getSetting');
});
