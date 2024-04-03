<?php

use App\Domains\Core\Controllers\CoreController as Core;

const GLOBAL_CORE_PREFIX = 'core';

Route::group(['prefix' => GLOBAL_CORE_PREFIX, 'as' => GLOBAL_CORE_PREFIX .'.',
    'middleware' => ['api','domain.check']], function () {

    Route::get('/operators',[Core::class,'index'])->name('operators.index');
    Route::get('/operators/{id}',[Core::class,'show'])->name('operators.show');

    Route::middleware(['auth:api'])->group( function () {
        Route::post('/operators',[Core::class,'store'])->name('operators.store');
    });

});
