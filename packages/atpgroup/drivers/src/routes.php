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

Route::group(['namespace' => 'ATPGroup\Drivers\Controllers\Admin', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::get('driver/activated/{driver}', 'DriverController@activated')->name('driver.activated');
    Route::get('driver/getDrivers', 'DriverController@getDrivers')->name('driver.getDrivers');
    Route::resource('driver', 'DriverController')->except(['show']);

    Route::get('driverDocument/print/{driverDocument}', 'DriverDocumentController@print')->name('driverDocument.print');
    Route::resource('driverDocument', 'DriverDocumentController')->except(['show']);

    Route::get('driverVehicle/getVehicles', 'DriverVehicleController@getVehicles')->name('driverVehicle.getVehicles');
    Route::resource('driverVehicle', 'DriverVehicleController')->except(['index', 'create', 'store', 'show', 'destroy']);
});

/*
|--------------------------------------------------------------------------
| API Routes Not Auth
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['namespace' => 'ATPGroup\Drivers\Controllers\API\OTP', 'prefix' => '/api/driver', 'middleware' => ['set.api.locale']], function () {
    Route::post('check-login-otp', 'CheckLoginOTPController@checkCredentials');
    Route::post('login-otp', 'LoginOTPController@login');
    Route::post('send-otp-code', 'SendOTPCodeController@send');
    Route::post('verify-otp-code', 'VerifyOTPCodeController@verifyOTPCode');
    Route::post('reset-password-otp-code', 'ResetPasswordOTPController@reset');
    Route::post('mobile-number-request-send-otp-code', 'SendOTPCodeController@mobileNumberRequestSendOtpCode');
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

Route::group(['namespace' => 'ATPGroup\Drivers\Controllers\API', 'prefix' => '/api/driver', 'middleware' => ['auth:api', 'set.api.locale']], function () {
    Route::post('logout', 'LogoutController@logout');
    Route::get('profile', 'DriverController@profile');
    Route::post('update-photo', 'DriverController@updatePhoto');
    Route::post('change-password', 'DriverController@changePassword');
    Route::post('change-mobile-number', 'DriverController@changeMobileNumber');
});
