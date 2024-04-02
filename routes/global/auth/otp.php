<?php

use App\Http\Controllers\API\Auth\Otp\OtpController as Otp;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController as AccessToken;
use Illuminate\Http\Request;

/* -----  API Routes --------------------------------------------------------------------- */

Route::group(['prefix' => 'otp', 'as' => 'otp.','middleware' => ['secret.check','throttle']], function () {
    Route::post('/verify',[Otp::class,'verifyOtp'])->name('auth.verifyOtp');
    Route::post('/resend',[Otp::class,'resendOtp'])->name('auth.resendOtp');
});
