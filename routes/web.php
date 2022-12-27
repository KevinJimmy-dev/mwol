<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/registre-se', 'AuthController@register')->name('auth.register');
    Route::post('/registre-se', 'AuthController@create')->name('auth.create');

    Route::get('/login', 'AuthController@login')->name('auth.login');
    Route::post('/login', 'AuthController@auth')->name('auth.authenticate');
    
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');

    Route::get('/esqueceu-sua-senha', 'RecoveryPasswordController@forgotPassword')->name('recovery-password');
    Route::post('/esqueceu-sua-senha', 'RecoveryPasswordController@sendEmail')->name('recovery-password.send-email');

    Route::get('/redefinir-sua-senha', 'RecoveryPasswordController@recoveryPassword')->name('recovery-password.index');
    Route::post('/redefinir-sua-senha', 'RecoveryPasswordController@recovery')->name('recovery-password.recovery');

    Route::middleware('auth')->prefix('painel')->name('panel.')->group(function () {
        Route::get('/', 'PanelController@index')->name('index');
    });
});