<?php

namespace App\Http\Controllers\API\Auth;

use App\Actions\Auth\GetUserAction;
use App\Actions\Auth\GetDomainConnectionAction;
use App\Enum\Field;
use App\Http\Resources\API\Auth\LogoutResource;
use App\Http\Resources\API\Auth\RefreshTokenResource;
use App\Http\Resources\API\Auth\TokenResource;
use App\Models\User;
use Illuminate\Http\Request;
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

        $token =  $this->makeToken($request);
        $dto = (object)[
            'token' => $token,
            'user' => $user,
        ];
        return TokenResource::make($dto);
    }

    public function refreshToken(ServerRequestInterface $request): RefreshTokenResource
    {
        $token =  $this->makeToken($request);
        $dto = (object)[  'token' => $token];
        return RefreshTokenResource::make($dto);
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
