<?php

namespace App\Http\Controllers\API\Auth;

use GuzzleHttp\Psr7\ServerRequest;
use Laravel\Passport\Http\Controllers\AccessTokenController as PassportAccessTokenController;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseController extends PassportAccessTokenController
{
    public function makeToken($request): array
    {
        if($request instanceof FormRequest)
        {
            $request =  ServerRequest::fromGlobals()->withParsedBody($request->all());
        }

        $tokenHttpResponse =  $this->issueToken($request);
        return json_decode($tokenHttpResponse->content(), true);
    }
}
