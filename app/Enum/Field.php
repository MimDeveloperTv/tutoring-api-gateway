<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class Field extends Enum
{
    public const PHONE = 'phone';

    public const MOBILE = 'mobile';
    public const USERNAME = 'username';
    public const PASSWORD = 'password';
    public const ACTIVE = 'is_active';
    public const CLIENT_ID = 'client_id';

    public const IS_USER = 'is_user';
    public const IS_MEMBER_GROUP = 'is_member_group';

    public const ID = 'id';
    public const NAME = 'name';
    public const STATUS = 'status';

    public const ACTION = 'action';
    public const USER_STATUS = 'user_status';
    public const OTP = 'otp';
    public const MESSAGE = 'message';
    public const DATA = 'data';
    public const USER_PURVIEW = 'user_purview';
    public const USER = 'user';
    public const USER_ID = 'user_id';

    public const IS_NEED_CHALLENGE = 'is_need_challenge';
    public const VERIFY_CHALLENGE = 'verify_challenge';
    public const CODE = 'code';
    public const USER_GROUP = 'user_group';

    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const FATHER_NAME = 'father_name';
    public const IDENTIFICATION_NUMBER = 'identification_number';
    public const GENDER = 'gender';

    public const CLIENT_SECRET = 'client_secret';
    public const IS_REGISTERED = 'is_registered';
    public const TOKEN = 'token';
    public const GRANT_TYPE = 'grant_type';
    public const SCOPE = 'scope';
    public const SECRET = 'secret';
    public const PASSWORD_GRANT = 'password_client';
    public const EXIST_MEMBER_GROUP = true;
}
