<?php

use App\Enum\UserGroup;
use App\Enum\GrantType;
use App\Enum\LookupAction as Action;
use App\Enum\UserPurview as Purview;
use App\Enum\UserStatus as UserStatus;

return [
    UserGroup::SUBSCRIBER => 'کاربر مشترک',
    UserGroup::ADMIN => 'کاربر مدیریت',
    UserGroup::AGENT => 'کاربر عامل',
    UserGroup::SUPER_AGENT => 'کاربر عامل',
    UserGroup::MERCHANT => 'کاربر تاجر',
    UserGroup::DISTRIBUTOR => 'کاربر توزیع کننده',
    GrantType::PASSWORD => 'رمز اعطای رمز عبور',
    GrantType::BASIC => 'اعتبار پایه',
    Action::REGISTER => 'ثبت نام',
    Action::LOGIN => 'ورود',
    Action::OTP => 'otp',
    Purview::NOT_REGISTERED => 'ثبت نشده است',
    Purview::REGISTERED => 'ثبت شده است',
    UserStatus::VERIFY_OTP => 'ثبت شده است',
];
