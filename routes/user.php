<?php

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

Route::get('/', function () {
    return view('user.welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('test-auth-api-session', function () {
    return view('user.test-auth-api-session');
});

Route::group(
    [
        'prefix' => 'api',
        'middleware' => ['auth'],
    ],
    function () {
        Route::post('test-auth-use-session', function () {
            return response()->json([
                'message' => 'This is a result!'
            ], 200);
        });
    }
);