<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::middleware('auth')->group(function () {
        Route::resource('users', 'UserController')->only([
            'edit', 
            'update',
        ]);
        Route::post('words/import', 'WordController@import')->name('importWord');
        Route::get('words/export', 'WordController@export')->name('exportWord');
        Route::resource('words', 'WordController');
        Route::delete('words/delete/{wordId}/{typeId}', 'WordController@delete')->name('deleteWord');
        Route::get('words/fix/{wordId}/{typeId}', 'WordController@fix')->name('editWord');
        Route::resource('tests', 'TestController');
    });
    Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider')->name('redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
});
