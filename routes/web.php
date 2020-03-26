<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'index';
});

Auth::routes();
Route::get('/home', 'HomeController@index')
    ->middleware('auth')
    ->name('home');

// CRUD routes
Route::resource('posts', 'PostController');
