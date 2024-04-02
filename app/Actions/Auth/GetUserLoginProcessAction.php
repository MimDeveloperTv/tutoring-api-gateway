<?php

namespace App\Actions\Auth;

use App\Enum\Field;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Utils\Utils;

class GetUserLoginProcessAction
{
    use AsAction;

    /**
     */
    public function handle(string $username):Model|null
    {
        $user = Utils::getUserByUsername($username);
        $userId = data_get($user, Field::ID);
        Utils::checkPassword($user, request(Field::PASSWORD));

        $client = Utils::getClient(request(Field::CLIENT_ID));
        $clientName = data_get($client, Field::NAME);

        Utils::checkUserGroup($userId, $clientName);
        return $user;
    }
}
