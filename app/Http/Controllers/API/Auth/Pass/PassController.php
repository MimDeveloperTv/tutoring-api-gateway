<?php

namespace App\Http\Controllers\API\Auth\Pass;

use App\Actions\Auth\GetUserLoginProcessAction;
use App\Enum\Field;
use App\Http\Controllers\API\Auth\BaseController;
use App\Http\Resources\API\Auth\Pass\LogoutResource;
use App\Http\Resources\API\Auth\Pass\ValidateTokenResource;
use App\Http\Resources\API\Auth\Pass\TokenResource;
use App\Models\User;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;

class PassController extends BaseController
{
    /**
     * @throws RequestException
     * @throws \Throwable
     */
    public function login(ServerRequestInterface $request): TokenResource
    {
        //todo : validation mobile & password : coming soon

        $username = request(Field::USERNAME);
        $user =  GetUserLoginProcessAction::make()->handle($username);
        $tokenData =  $this->makeToken($request);

        return TokenResource::make($tokenData);
    }

    public function refreshToken(ServerRequestInterface $request): TokenResource
    {
        $tokenData =  $this->makeToken($request);
        return TokenResource::make($tokenData);
    }
    public function validateToken(Request $request): ValidateTokenResource
    {
        /* @var $user User */
        $user = auth()->user();
        $token = $request->user()->token();
        $client = $token->client()->first()->toArray();
        $data = (object) [
            'user' => $user,
            'client' => $client,
            'token' => $token,
        ];
        return ValidateTokenResource::make($data);
    }
    public function logout (Request $request)
    {
        /* @var $user User */
        $user =  auth()->user();
        $userAccessToken = $user->token();
        $userAccessToken->revoke();
        $userAccessToken->refresh()->revoke();
        return LogoutResource::make($request);
    }
}
