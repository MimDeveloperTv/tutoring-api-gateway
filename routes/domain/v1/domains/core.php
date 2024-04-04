<?php

use App\Domains\Core\Controllers\CoreController as Core;

const DOMAIN_CORE_PREFIX = 'core';

Route::group(['prefix' => DOMAIN_CORE_PREFIX, 'as' => DOMAIN_CORE_PREFIX .'.'], function () {
    Route::post('/operators',[Core::class,'operatorStore'])->name('operators.store');

    Route::get('/personnel',[Core::class,'personnelIndex'])->name('personnel.index');
    Route::get('/personnel/{id}',[Core::class,'personnelShow'])->name('personnel.show');
});
