<?php

namespace App\Actions\Auth;

use App\Enum\Field;
use App\Transporter\Auth\CheckUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserAction
{
    use AsAction;

    /**
     * @throws ValidationException
     */
    public function handle(string $username,string $password): object
    {
        $inputs = [
            'username' => $username,
            'password' => $password,
        ];
        Validator::validate($inputs,[ 'password' => 'required', 'username' => 'required']);

        $response = CheckUserRequest::build()
            ->withData([
                Field::MOBILE => $username,
                Field::PASSWORD => $password,
            ])
            ->send();

        abort_unless($response->ok(), UnauthorizedException::class);

        return (object)$response->json('user');
    }
}
