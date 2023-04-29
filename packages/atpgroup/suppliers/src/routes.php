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

Route::group(['namespace' => 'ATPGroup\Suppliers\Controllers', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::resource('supplier', 'SupplierControoler')->except(['show']);
});
