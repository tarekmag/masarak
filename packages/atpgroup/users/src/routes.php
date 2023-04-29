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

Route::group(['namespace' => 'ATPGroup\Users\Controllers', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::get('user/profile', 'UserController@profile')->name('user.profile');
    Route::post('user/updateProfile', 'UserController@updateProfile')->name('user.updateProfile');
    Route::get('user/activated/{user}', 'UserController@activated')->name('user.activated');
    Route::resource('user', 'UserController')->except(['show']);
});
