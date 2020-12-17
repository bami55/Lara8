<?php



/*
-------------------------------------------------------------------------
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

Route::get('customer/{id}', function ($id) {
    $customer = App\Customer::find($id);
    echo $customer->name;
});

Route::get('customer_name', function () {
    $customer = App\Customer::where('name', '=', 'Bob')->first();
    echo $customer->id;
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
