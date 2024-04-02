<?php

namespace App\Domains\Global\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

/* Contracts */
use App\Domains\User\Contracts\UserContract;
use App\Domains\Card\Contracts\CardContract;

/* Services */
use App\Domains\User\Services\UserService;
use App\Domains\Card\Services\CardService;


class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserContract::class, UserService::class);
        $this->app->bind(CardContract::class, CardService::class);
    }

    public function boot(Request $request): void
    {

    }
}
