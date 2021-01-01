<?php


/*
--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
}
);

Route::prefix('system')->group(function() {
    Auth::routes();
    Route::get('/', function() {
	    return view('system');
    });

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('system.login');
    Route::post('login', 'Auth\LoginController@login')->name('system.login');

    Route::get('common', 'CommonController@index')->name('system.common');
});

Route::prefix('admin')->group(function() {
    Auth::routes();
    Route::get('/', function() {
	    return view('admin');
    });

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login');

    Route::get('common', 'CommonController@index')->name('admin.common');
});

Route::prefix('user')->group(function() {
    Auth::routes();
    Route::get('/', function() {
	    return view('user');
    });

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('user.login');
    Route::post('login', 'Auth\LoginController@login')->name('user.login');

    Route::get('common', 'CommonController@index')->name('user.common');
});

Route::get('/home', 'HomeController@index')->name('home');
