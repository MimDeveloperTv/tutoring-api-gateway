<?php

namespace App\Core\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Negotiation\LanguageNegotiator as Lang;

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Request $request): void
    {
        app()->setLocale($this->getLocaleFromRequest($request));
    }

    private function getLocaleFromRequest(Request $request)
    {
        $selectedLocale = config('app.locale');
        $languages = $request->server('HTTP_ACCEPT_LANGUAGE');
        if (!empty($languages)) {
            $locales = array_keys(config('app.locales'));
            $langSelector = new Lang();
            $selectedLocale = $langSelector->getBest($languages, $locales)->getType();
        }

        return $selectedLocale;
    }
}
