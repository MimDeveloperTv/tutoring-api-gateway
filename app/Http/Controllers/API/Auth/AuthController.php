<?php

namespace App\Http\Controllers\API\Auth;

use App\Actions\Auth\GetUserAction;
use App\Actions\Auth\CreateUserConnectionAction;
use App\Actions\Auth\GetDomainConnectionAction;
use App\Enum\Field;
use App\Http\Resources\API\Auth\LogoutResource;
use App\Http\Resources\API\Auth\TokenResource;
use App\Http\Resources\API\Auth\ValidateTokenResource;
use App\Models\User;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends BaseController
{
    /**
     * @throws \Throwable
     */
    public function login(ServerRequestInterface $request): TokenResource
    {
        $username = request(Field::USERNAME);
        $password = request(Field::PASSWORD);
        $user = GetUserAction::make()->handle($username,$password);
        GetDomainConnectionAction::make()->handle();

        $token =  $this->makeToken($request);
        $dto = (object)[
            'token' => $token,
            'user' => $user,
        ];
        return TokenResource::make($dto);
    }

    public function refreshToken(ServerRequestInterface $request): TokenResource
    {
        $tokenData =  $this->makeToken($request);
        return TokenResource::make($tokenData);
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
