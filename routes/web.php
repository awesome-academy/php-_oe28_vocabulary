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
        Route::resource('words', 'WordController');
        Route::delete('words/delete/{wordId}/{typeId}', 'WordController@delete')->name('deleteWord');
        Route::get('words/fix/{wordId}/{typeId}', 'WordController@fix')->name('editWord');
    });
});
