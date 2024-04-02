<?php

use App\Http\Controllers\API\Auth\AuthController as Auth;
use App\Http\Controllers\API\Auth\LookupController as Lookup;
use App\Http\Controllers\API\EnumController as Enum;

Route::group(['prefix' => 'auth', 'as' => 'auth.','middleware' => 'api'], function () {

    Route::group(['middleware' => ['secret.check','throttle']], function () {

        Route::post('/login',[Auth::class,'login'])->middleware('domain.check')->name('auth.login');

        Route::post('/refresh-token',[Auth::class,'refreshToken']) ->name('auth.refreshToken');

        Route::middleware('auth:api')->group( function () {
            Route::post('/logout',[Auth::class,'logout'])->name('auth.logout');
        });

    });

    Route::post('/lookup',[Lookup::class,'lookup'])->name('auth.lookup')
        ->middleware('secret.check');
});


Route::get('/enums',[Enum::class,'enums'])->name('enums');
