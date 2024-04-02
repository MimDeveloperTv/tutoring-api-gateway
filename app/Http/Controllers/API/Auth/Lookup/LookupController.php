<?php

namespace App\Http\Controllers\API\Auth\Lookup;

use App\Actions\Auth\Lookup\AfterLookupAction;
use App\Actions\Auth\Lookup\LookupAction;
use App\Http\Controllers\API\Auth\BaseController;
use Illuminate\Http\Client\RequestException;
use App\Http\Requests\API\Auth\UserLookupRequest;
use App\Http\Resources\API\Auth\Lookup\LookupResource;

class LookupController extends BaseController
{
    /**
     * @throws RequestException
     */
    public function lookup(UserLookupRequest $request)
    {
       $dto =  LookupAction::make()->handle($request->getUsername(),$request->getClientId());
       $dto = AfterLookupAction::make()->handle($dto,$request->getUsername());

       return LookupResource::make($dto);
    }

}
