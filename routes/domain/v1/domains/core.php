<?php

use App\Domains\Core\Controllers\CoreController as Core;

const DOMAIN_CORE_PREFIX = 'core';

Route::group(['prefix' => DOMAIN_CORE_PREFIX, 'as' => DOMAIN_CORE_PREFIX .'.'], function () {
    Route::post('/operators',[Core::class,'operatorStore'])->name('operators.store');

    Route::get('/personnel',[Core::class,'personnelIndex'])->name('personnel.index');
    Route::get('/personnel/{id}',[Core::class,'personnelShow'])->name('personnel.show');

    Route::get('/patients',[Core::class,'patientIndex'])->name('patients.index');
    Route::get('/patients/{id}',[Core::class,'patientShow'])->name('patients.show');
    Route::post('/patients',[Core::class,'patientStore'])->name('patients.store');

    //todo:implement more patients Op in Core Service

    Route::get('/user/{id}/patient',[Core::class,'userPatientShow'])->name('user.patient.show');
    Route::post('/user/{id}/patient',[Core::class,'userPatientStore'])->name('user.patient.store');
    Route::get('/user/{id}/operator',[Core::class,'userOperatorShow'])->name('user.operator.show');
    Route::post('/user/{id}/operator',[Core::class,'userOperatorStore'])->name('user.operator.store');

    Route::get('/appointments',[Core::class,'appointmentIndex'])->name('user.appointments.index');
    Route::patch('/appointments/{id}/status',[Core::class,'appointmentStatusUpdate'])
        ->name('user.patient.update');
    Route::patch('/appointments/{id}/payment-status',[Core::class,'appointmentPaymentStatusUpdate'])
        ->name('user.patient.update');

});
