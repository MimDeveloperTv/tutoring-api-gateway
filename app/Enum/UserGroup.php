<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;
class UserGroup extends Enum
{
    public const KEY = 'user_group';
    public const ADMIN = 'ADMIN';
    public const AGENT = 'AGENT';

    public const SUBSCRIBER = 'SUBSCRIBER';
    public const SUPER_AGENT = 'SUPER_AGENT';
    public const MERCHANT = 'MERCHANT';
    public const DISTRIBUTOR = 'DISTRIBUTOR';

    public const VALUES = [
        self::ADMIN,
        self::AGENT,
        self::SUBSCRIBER,
        self::SUPER_AGENT,
        self::MERCHANT,
        self::DISTRIBUTOR,
    ];

    public const FORMATS = [
        self::ADMIN => self::ADMIN,
        self::AGENT => self::AGENT,
        self::SUBSCRIBER => self::SUBSCRIBER,
        self::SUPER_AGENT => self::SUPER_AGENT,
        self::MERCHANT => self::MERCHANT,
        self::DISTRIBUTOR => self::DISTRIBUTOR,
    ];

}
