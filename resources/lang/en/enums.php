<?php

use App\Enum\UserGroup;
use App\Enum\GrantType;
use App\Enum\LookupAction as Action;
use App\Enum\UserPurview as Purview;
use App\Enum\UserStatus as UserStatus;
use App\Enum\Gender as Gender;

return [
    UserGroup::SUBSCRIBER => 'subscriber user',
    UserGroup::ADMIN => 'admin user',
    UserGroup::AGENT => 'agent user',
    UserGroup::SUPER_AGENT => 'super-agent user',
    UserGroup::MERCHANT => 'merchant user',
    UserGroup::DISTRIBUTOR => 'distributor user',
    GrantType::PASSWORD => 'Password Grant Token',
    GrantType::BASIC => 'Basic Auth',
    Action::REGISTER => 'register',
    Action::LOGIN => 'login',
    Action::OTP => 'otp',
    Purview::NOT_REGISTERED => 'not registered',
    Purview::REGISTERED => 'registered',
    UserStatus::VERIFY_OTP => 'registered',
    Gender::MALE => 'male',
    Gender::FEMALE => 'female',
    Gender::OTHER => 'other',
    '' => []
    ];
