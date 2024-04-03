<?php

use App\Http\Controllers\API\EnumController as Enum;

Route::group(['middleware' => 'api'], function () {
    Route::get('/enums', [Enum::class, 'enums'])->name('enums');
});
