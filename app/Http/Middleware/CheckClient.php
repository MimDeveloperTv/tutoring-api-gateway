<?php

namespace App\Http\Middleware;

use App\Enum\Field;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Symfony\Component\HttpFoundation\Response;
use \App\Enum\GrantType;
class CheckClient
{
    public const CONFIG_CLIENT_SECRET_KEY = 'auth.oauth.clients.users.secret';
    public const CONFIG_CLIENT_ID_KEY = 'auth.oauth.clients.users.id';
    public const CLIENT_SECRET_KEY = 'client_secret';
    public const CLIENT_ID_KEY = 'client_id';

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientId = $request->input(self::CLIENT_ID_KEY);
        $allowedSecretClientId = config(self::CONFIG_CLIENT_ID_KEY);
        $isExistClientSecret = $request->input(self::CLIENT_SECRET_KEY);

        if (empty($isExistClientSecret) && $clientId == $allowedSecretClientId) {
            $isExistClientSecret = config(self::CONFIG_CLIENT_SECRET_KEY);
            $request->merge([self::CLIENT_SECRET_KEY => $isExistClientSecret]);
        } else {

            $grantType = $this->getGrantType();
            $clientRep = $this->fetchClient($clientId,$isExistClientSecret,$grantType);
            if (!$clientRep) {
                throw new AuthorizationException;
            }
        }

        return $next($request);
    }

    public function enableGrantTypePassword(): array
    {
        return [ Field::PASSWORD_GRANT => 1];
    }

    public function getGrantType(): array
    {
        $grantType = GrantType::IDENTIFIER ;
        if($grantType == GrantType::PASSWORD){
            return $this->enableGrantTypePassword();
        }
        return [];
    }

    public function fetchClient($clientId,$clientSecret,$grantType)
    {
      return  Client::query()->where(array_merge(
            [Field::ID => $clientId],
            [Field::SECRET => $clientSecret],
            $grantType))->exists();
    }

}
