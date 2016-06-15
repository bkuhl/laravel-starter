<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
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


/**
 * Healthcheck to ensure the application is healthy.  When deployed this endpoint will determine healthy nodes
 * where the application can live.  In the event of network connectivity failure with any external dependencies,
 * this healthcheck should fail.
 */
Route::get('/healthcheck/{token}', function ($token) {
    if ($token == env('HEALTHCHECK_TOKEN')) {
        $connection = DB::connection();
        $connection->disconnect();

        return response('');
    }

    throw new \Exception('Invalid healthcheck token');
});
