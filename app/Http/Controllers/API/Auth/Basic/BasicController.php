<?php

namespace App\Http\Controllers\API\Auth\Basic;

use App\Actions\Auth\GetUserLoginProcessAction;
use App\Actions\Auth\Otp\SendOtpAction;
use App\Enum\Field;
use App\Http\Controllers\API\Auth\BaseController;
use App\Http\Resources\API\Auth\Basic\LoginResource;
use App\Http\Resources\API\Auth\Basic\LogoutResource;
use App\Http\Resources\API\Auth\Basic\ValidateTokenResource;
use App\Models\User;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;

class BasicController extends BaseController
{
    /**
     * @throws RequestException
     */
    public function login(ServerRequestInterface $request): LoginResource
    {
        //todo : validation mobile & password : coming soon

        $username = request(Field::USERNAME);
        $user =  GetUserLoginProcessAction::make()->handle($username);
        $token =  $this->makeToken($request);

        $data = (object) [
            'user' => $user,
            'token' => $token,
        ];
        return LoginResource::make($data);
    }

    public function logout(Request $request): LogoutResource
    {
        $request->user()->token()->revoke();
        return LogoutResource::make($request);
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
}
