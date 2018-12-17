<?php

Route::redirect('/', '/home');
Route::group([
    'middleware' => ['web', 'auth'],
    'namespace' => 'Dashboard\Controllers'
], function () {
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@indexAction')
            ->name('home');
        Route::post('send-email', 'EmailController@sendAction')
            ->name('email.send');
    });
});