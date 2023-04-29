<?php

use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['set.language'])->group(function () {
    Auth::routes(['register' => false]);
});

Route::get('phpinfo', function(){ 
    phpinfo();
});

Route::post('pusher/auth', function(){
    $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
    return $pusher->socket_auth(request()->channel_name, request()->socket_id);
});

Route::group(['namespace' => 'ATPGroup\Routes\Controllers\Front', 'middleware' => ['web', 'set.language']], function () {
    Route::get('trip/cancel', 'TripController@employeeCancelTrip');
});

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get('privacy-policy', 'PrivacyPolicyController@index');
});
