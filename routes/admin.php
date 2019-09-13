<?php

Route::get('/', function () {
    return view('admin.welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');//->middleware('admin-verified');
