<?php

use App\Http\Controllers\API\Auth\Pass\PassController as Auth;
use Illuminate\Support\Facades\Route;

/* -----  API Routes --------------------------------------------------------------------- */

Route::group(['prefix' => 'pass', 'as' => 'pass.','middleware' => ['secret.check','throttle']], function () {
    Route::post('/login',[Auth::class,'login']) ->name('auth.login');
    Route::post('/refresh-token',[Auth::class,'refreshToken']) ->name('auth.refreshToken');

    Route::middleware('auth:api')->group( function () {
        Route::post('/validate-token',[Auth::class,'validateToken'])->name('auth.validate');
        Route::post('/logout',[Auth::class,'logout'])->name('auth.logout');
    });

});
