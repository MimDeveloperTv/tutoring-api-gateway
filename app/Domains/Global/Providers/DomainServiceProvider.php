<?php

namespace App\Domains\Global\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

/* Contracts */
use App\Domains\Core\Contracts\CoreContract;


/* Services */
use App\Domains\Core\Services\CoreService;


class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CoreContract::class, CoreService::class);
    }

    public function boot(Request $request): void
    {

    }
}
