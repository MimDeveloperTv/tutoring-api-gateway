<?php

namespace App\Domains\Core\Controllers;

use App\Domains\Core\Contracts\CoreContract;
use App\Domains\Global\Controllers\DomainController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoreController extends DomainController
{
    public function __construct(
        private readonly CoreContract $coreService,
    )
    {
    }

    public function operatorIndex(Request $request): JsonResponse
    {
        return $this->index($this->coreService->operatorIndex($request->toArray()));
    }

    public function operatorShow(string $id): JsonResponse
    {
        return $this->show($this->coreService->operatorShow($id));
    }

    public function operatorStore(Request $request): JsonResponse
    {
        return $this->store($this->coreService->operatorStore($request->toArray()));
    }


    public function personnelIndex(Request $request): JsonResponse
    {
        return $this->index($this->coreService->personnelIndex($request->toArray()));
    }

    public function personnelShow(string $id): JsonResponse
    {
        return $this->show($this->coreService->personnelShow($id));
    }


    public function patientIndex(Request $request): JsonResponse
    {
        return $this->index($this->coreService->patientIndex($request->toArray()));
    }

    public function patientShow(string $id): JsonResponse
    {
        return $this->show($this->coreService->patientShow($id));
    }

    public function patientStore(Request $request): JsonResponse
    {
        return $this->store($this->coreService->patientStore($request->toArray()));
    }


    public function userPatientShow(string $id): JsonResponse
    {
        return $this->show($this->coreService->userPatientShow($id));
    }

    public function userPatientStore(Request $request,string $id): JsonResponse
    {
        return $this->store($this->coreService->userPatientStore($id,$request->toArray()));
    }

    public function userOperatorShow(string $id): JsonResponse
    {
        return $this->show($this->coreService->userOperatorShow($id));
    }

    public function userOperatorStore(Request $request,string $id): JsonResponse
    {
        return $this->store($this->coreService->userOperatorStore($id,$request->toArray()));
    }



    public function appointmentIndex(Request $request): JsonResponse
    {
        return $this->index($this->coreService->appointmentIndex($request->toArray()));
    }

    public function appointmentStatusUpdate(Request $request,string $id): JsonResponse
    {
        return $this->update($this->coreService->appointmentStatusUpdate($id,$request->toArray()));
    }

    public function appointmentPaymentStatusUpdate(Request $request,string $id): JsonResponse
    {
        return $this->update($this->coreService->appointmentPaymentStatusUpdate($id,$request->toArray()));
    }



}
