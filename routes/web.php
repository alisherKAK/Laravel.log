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

Route::name('comments.')
    ->prefix('comments')
    ->middleware('auth')
    ->group(function () {

        Route::post('/', 'CommentController@store')
            ->name('store');
        Route::delete('/{comment}', 'CommentController@destroy')
            ->name('destroy');

    });
