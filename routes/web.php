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

Route::post('/posts/{post}/likes/count', 'LikeController@count')
    ->name('posts.likes.count');
Route::post('/posts/{post}/is_liked', 'LikeController@isLiked')
    ->name('posts.likes.is_liked');
Route::post('/posts/like/{post}', 'LikeController@like')
    ->name('posts.like')
    ->middleware('auth');


Route::post('/posts/{post}/is_favorite', 'FavoriteController@isFavorite')
    ->name('posts.favorite.is_favorite');
Route::post('/posts/favorite/{post}', 'FavoriteController@add')
    ->name('posts.favorite');

Route::name('comments.')
    ->prefix('comments')
    ->middleware('auth')
    ->group(function () {

        Route::post('/', 'CommentController@store')
            ->name('store');
        Route::delete('/{comment}', 'CommentController@destroy')
            ->name('destroy');

    });

