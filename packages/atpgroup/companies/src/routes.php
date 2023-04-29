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

Route::group(['namespace' => 'ATPGroup\Companies\Controllers', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::resource('company', 'CompanyController')->except(['show']);
    Route::get('branch/getBranches', 'BranchController@getBranches')->name('branch.getBranches');
    Route::resource('branch', 'BranchController')->except(['show']);
});
