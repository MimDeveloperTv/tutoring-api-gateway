<?php

namespace App\Actions\Auth\Lookup;

use App\Enum\Field;
use App\Enum\UserStatus;
use App\Utils\Utils;
use Illuminate\Http\Client\RequestException;
use Lorisleiva\Actions\Concerns\AsAction;

class LookupAction
{
    use AsAction;

    private bool $isMemberGroup = false;
    private bool $isUser = false;

    public function handle(string $username,string $clientId):array
    {
        $user = Utils::fetchUser($username);
        $client = Utils::getClient($clientId);
        $userId = data_get($user, Field::ID);
        $userStatus = data_get($user, Field::STATUS);
        $clientName = data_get($client, Field::NAME);

        if (!empty($userId) && !empty($client->exists)) {
            $this->isUser = true;
            $userGroup = Utils::fetchUserGroup($userId, $clientName);
            $this->isMemberGroup = !empty($userGroup);
        }

        return [
            Field::IS_USER => $this->isUser,
            Field::IS_MEMBER_GROUP => $this->isMemberGroup,
            Field::USER_STATUS => $userStatus,
        ];

    }
}
