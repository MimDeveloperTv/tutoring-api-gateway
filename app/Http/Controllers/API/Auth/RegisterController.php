<?php

namespace App\Http\Controllers\API\Auth;

use App\Actions\Auth\RegisterUserAction;
use App\Actions\Auth\VerifyChallenge\CheckVerifyChallengeAction;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\API\Auth\RegisterUserResource;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Request;

class RegisterController extends BaseController
{

    /**
     * @throws \Throwable
     */
    public function register(RegisterRequest $request):RegisterUserResource
    {
       CheckVerifyChallengeAction::make()->handle($request->getSecurityCode());

      $dto = RegisterUserAction::make()->handle($request->getRegisterData());

      $token =  $this->makeToken($request);

        $data = (object) [
            'operation' => $dto,
            'token' => $token,
        ];

       return RegisterUserResource::make($data);
    }

}
