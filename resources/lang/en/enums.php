<?php

use App\Enum\GrantType;
use App\Enum\LookupAction as Action;

return [
    GrantType::PASSWORD => 'Password Grant Token',
    Action::REGISTER => 'register',
    Action::LOGIN => 'login',
    '' => []
    ];
