<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registre-se', 'App\Http\Controllers\AuthController@register')->name('auth.register');
Route::post('/registre-se', 'App\Http\Controllers\AuthController@create')->name('auth.create');

Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
Route::post('/login', 'App\Http\Controllers\AuthController@auth')->name('auth.authenticate');

Route::get('/esqueceu-sua-senha', 'App\Http\Controllers\RecoveryPasswordController@forgotPassword')->name('recovery-password');
Route::post('/esqueceu-sua-senha', 'App\Http\Controllers\RecoveryPasswordController@sendEmail')->name('recovery-password.send-email');

Route::get('/redefinir-sua-senha', 'App\Http\Controllers\RecoveryPasswordController@recoveryPassword')->name('recovery-password.index');
Route::post('/redefinir-sua-senha', 'App\Http\Controllers\RecoveryPasswordController@recovery')->name('recovery-password.recovery');
