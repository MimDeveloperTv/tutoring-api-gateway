<?php

namespace App\Actions\Auth;

use App\Enum\Field;
use App\Enum\OtpMessage as Message;
use App\Enum\UserStatus;
use App\Transporter\Auth\RegisterRequest;
use App\Utils\Utils;
use Illuminate\Http\Client\RequestException;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterUserAction
{
    use AsAction;

    /**
     * @throws RequestException
     */
    public function handle(array $data): object
    {
        $isRegistered = false;
        $data = $this->assignUserGroup($data);
        $httpResponse = RegisterRequest::build()->withData($data)->send()->throw();
        $response = $httpResponse->json('data');
        $userStatus = data_get($response, 'user_status.id');
        $userGroup = data_get($response, 'user_group.id');
        $isRegistered = $httpResponse->ok() && $userStatus == UserStatus::REGISTERED;

        return (object)[
            Field::IS_REGISTERED => $isRegistered,
            Field::USER_STATUS => $userStatus,
            Field::USER_GROUP => $userGroup,
        ];
    }

    public function assignUserGroup($data): array
    {
        $client = Utils::getClient(request(Field::CLIENT_ID));
        $data[Field::USER_GROUP] = data_get($client, Field::NAME);
        return $data;
    }
}
