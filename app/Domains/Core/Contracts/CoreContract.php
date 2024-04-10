<?php

namespace App\Domains\Core\Contracts;

interface CoreContract
{
    public function operatorIndex(array $data): mixed;
    public function operatorShow(string $id): mixed;
    public function operatorStore(array $data): mixed;

    public function personnelIndex(array $data): mixed;
    public function personnelShow(string $id): mixed;


    public function patientIndex(array $data): mixed;
    public function patientShow(string $id): mixed;
    public function patientStore(array $data): mixed;


    public function userPatientShow(string $id): mixed;
    public function userPatientStore(string $id,array $data): mixed;
    public function userOperatorShow(string $id): mixed;
    public function userOperatorStore(string $id,array $data): mixed;


    public function appointmentIndex(array $data): mixed;
    public function appointmentStatusUpdate(string $id,array $data): mixed;
    public function appointmentPaymentStatusUpdate(string $id,array $data): mixed;

}
