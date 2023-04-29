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

Route::group(['namespace' => 'ATPGroup\Partials\Controllers\Admin', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    //
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

Route::group(['namespace' => 'ATPGroup\Partials\Controllers\API', 'prefix' => '/api', 'middleware' => ['auth:api', 'set.api.locale']], function () {

});

Route::group(['namespace' => 'ATPGroup\Partials\Controllers\API', 'prefix' => '/api/partials', 'middleware' => ['set.api.locale']], function () {
    Route::post('uploadImage', 'PartialController@uploadImage');
});
