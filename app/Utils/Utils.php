<?php

namespace App\Utils;

use App\Actions\Auth\AssignGroupUserAction;
use App\Enum\Field;
use App\Enum\Value;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Passport\Client;

class Utils
{
    //<editor-fold desc="Check Functions">
    public static function checkClient(string $clientId): bool
    {
        return Client::query()->find($clientId)->exists();
    }

    /**
     * @throws RequestException
     * @throws \Throwable
     */
    public static function checkUserGroup(string $userId, string $clientName): void
    {
        $existUser = UserGroup::query()->where(['user_id' => $userId, 'group' => $clientName])->exists();
        if(!$existUser && request(Field::IS_MEMBER_GROUP) != Value::EXIST_MEMBER_GROUP){
            AssignGroupUserAction::make()->handle($userId, $clientName);
            $existUser = !$existUser;
        }
        abort_unless($existUser, 401, UnauthorizedException::class);

    }
    public static function checkPassword(Model $user, string $password): void
    {
        $savedPassword = data_get($user, Field::PASSWORD);
        abort_unless(Hash::check($password, $savedPassword), 401, UnauthorizedException::class);
    }
    //</editor-fold>


    //<editor-fold desc="Get Functions">
    public static function getClient(string $clientId): Model
    {
        return Client::query()->findOrFail($clientId);
    }
    public static function getUserByUsername(string $username): Model
    {
        return User::query()->where(User::USERNAME_FIELD, $username)->firstOrFail();
    }
    //</editor-fold>



    //<editor-fold desc="Fetch Functions">
    public static function fetchUserGroup(string $userId, string $clientName) :Model|null
    {
        return UserGroup::query()->where(['user_id' => $userId, 'group' => $clientName])->first();
    }

    public static function fetchUser(string $username): Model|null
    {
        return User::query()->where(User::USERNAME_FIELD, $username)->first();
    }
    //</editor-fold>
}
