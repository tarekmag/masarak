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

Route::group(['namespace' => 'ATPGroup\Notifications\Controllers\Admin', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::post('notification/markAsRead', 'NotificationController@markAsRead')->name('notification.markAsRead');
    Route::get('notification/loadMoreNotify', 'NotificationController@loadMoreNotify')->name('notification.loadMoreNotify');
    Route::get('notification/index', 'NotificationController@index')->name('notification.index');
    Route::delete('notification/destroy', 'NotificationController@destroy')->name('notification.destroy');

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

Route::group(['namespace' => 'ATPGroup\Notifications\Controllers\API', 'prefix' => '/api', 'middleware' => ['auth:api', 'set.api.locale']], function () {
    Route::get('notification/all', 'NotificationController@index');
    Route::get('notification/unread', 'NotificationController@unread');
    Route::get('notification/unreadCount', 'NotificationController@unreadCount');
    Route::get('notification/read', 'NotificationController@read');
    Route::get('notification/{notify}', 'NotificationController@show');
    Route::post('notification/delete', 'NotificationController@destroy');
});
