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

        Route::name('word.')->group(function () {
            Route::get('/palavras', 'WordController@index')->name('index');
            Route::post('/palavras/cadastrar', 'WordController@store')->name('store');
            Route::put('/palavras/editar/{id}', 'WordController@update')->name('update');
            Route::delete('/palavras/excluir/{id}', 'WordController@delete')->name('delete');
        });

        Route::name('phrase.')->group(function () {
            Route::get('/frases', 'PhraseController@index')->name('index');
            Route::post('/frases/cadastrar', 'PhraseController@store')->name('store');
            Route::put('/frases/editar/{id}', 'PhraseController@update')->name('update');
            Route::delete('/frases/excluir/{id}', 'PhraseController@delete')->name('delete');
        });
    });
});
