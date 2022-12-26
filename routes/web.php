<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registre-se', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/criar-conta', 'App\Http\Controllers\AuthController@create')->name('register-create');
