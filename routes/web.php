<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@home');
Auth::routes();
Route::get('home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController')->only([
    'edit', 
    'update',
]);
