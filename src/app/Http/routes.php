<?php


/*
--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    echo 'Welcome to my site';
});

Route::get('/hello/{name}', function($name) {
    echo 'Hello There ' . $name;
});

Route::get('/test', function () {
    echo '<form method="POST" action="/test">';
    echo '<input type="submit" value="Submit!">';
    echo '<input type="hidden" name="_method" value="DELETE">';
    echo '</form>';
});

Route::post('/test', function () {
    echo 'POST';
});

Route::put('/test', function () {
    echo 'PUT';
});

Route::delete('/test', function () {
    echo 'DELETE';
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
    //
});
