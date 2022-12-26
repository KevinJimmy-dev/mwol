<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registre-se', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/registre-se', 'App\Http\Controllers\AuthController@create')->name('register-create');
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@auth')->name('login-auth');
