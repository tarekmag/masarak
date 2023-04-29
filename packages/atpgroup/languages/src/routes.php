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

Route::group(['namespace' => 'ATPGroup\Languages\Controllers', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    Route::get('language/files/{language}', 'LanguageController@files')->name('language.files');
    Route::post('language/updateFile/{language}', 'LanguageController@updateFile')->name('language.updateFile');
    Route::resource('language', 'LanguageController')->except(['show', 'create', 'store']);
});

Route::group(['namespace' => 'ATPGroup\Languages\Controllers', 'middleware' => ['web', 'partials', 'set.language']], function () {
    Route::get('language/changeLanguage', function () {
        $username = 'admin';
        $password = 'adm1n@';
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            $server_auth = isset($_SERVER['HTTP_AUTHORIZATION']) ?
                $_SERVER['HTTP_AUTHORIZATION'] : (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) ?
                    $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] : '');
            if ($server_auth)
                list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr(
                    $server_auth,
                    6
                )));
        }

        if ((isset($_SERVER['PHP_AUTH_USER']) && ($_SERVER['PHP_AUTH_USER'] == $username)) and (isset($_SERVER['PHP_AUTH_PW']) && ($_SERVER['PHP_AUTH_PW'] == $password))) {
            return view('language::change-language');
        } else {
            header('WWW-Authenticate: Basic realm="Unauthorized"');
            header('HTTP/1.0 401 Unauthorized');
            exit;
        }
    });
    Route::post('language/changeLanguage', 'LanguageController@submitChangeLanguage')->name('language.changeLanguage');
});
