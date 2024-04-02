<?php

use App\Domains\Card\Controllers\CardController;

const CARD_PREFIX = 'cards';

Route::group(['prefix' => CARD_PREFIX, 'as' => CARD_PREFIX .'.'], function () {

    Route::get('/',[CardController::class,'index'])->name('card.index');
    Route::get('/{id}',[CardController::class,'show'])->name('card.show');
    Route::post('/',[CardController::class,'store'])->name('card.store');

});
