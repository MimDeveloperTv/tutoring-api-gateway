<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use \Illuminate\Routing\RouteRegistrar;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    public const DOMAIN_MIDDLEWARES = ['api', 'auth:api'];

    private const PREFIX_V1 = 'v1';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            $this->defaultGlobalRegister();
            $this->domainV1Register();
        });

    }

    public function defaultGlobalRegister(): RouteRegistrar
    {
        return Route::prefix('api')->group(base_path('routes/global/global.php'));
    }

    public function domainV1Register(): RouteRegistrar
    {
        $v1Prefix = self::PREFIX_V1;
        return Route::prefix("domain/{$v1Prefix}")->name("domain.{$v1Prefix}.")
            ->middleware(self::DOMAIN_MIDDLEWARES)
            ->group(base_path("routes/domain/{$v1Prefix}/domain.php"));
    }

}
