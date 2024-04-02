<?php

use App\Domains\User\Controllers\UserController;

const USER_PREFIX = 'user';

Route::group(['prefix' => USER_PREFIX, 'as' => USER_PREFIX .'.'], function () {

    Route::get('/info',[UserController::class,'info'])->name('user.info');

});
