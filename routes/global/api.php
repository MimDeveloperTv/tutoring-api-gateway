<?php

use App\Http\Controllers\API\Auth\Lookup\LookupController as Lookup;
use App\Http\Controllers\API\Auth\RegisterController as Register;
use App\Http\Controllers\API\EnumController as Enum;

Route::group(['prefix' => 'auth', 'as' => 'auth.','middleware' => 'api'], function () {
    include 'auth/basic.php';
    include 'auth/pass.php';
    include 'auth/otp.php';

    Route::post('/lookup',[Lookup::class,'lookup'])->name('auth.lookup')
        ->middleware('secret.check');

    Route::post('/register',[Register::class,'register'])->name('auth.register')
        ->middleware('secret.check');

});


Route::get('/enums',[Enum::class,'enums'])->name('enums');
