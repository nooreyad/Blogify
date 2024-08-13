<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
use Laravel\Passport\AuthCode as PassportAuthCode;
use Laravel\Passport\Bridge\RefreshToken as BridgeRefreshToken;
use Laravel\Passport\Client as PassportClient;
use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::enablePasswordGrant();

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Passport::hashClientSecrets();
        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        // Passport::ignoreRoutes();
        // Passport::tokensExpireIn(now()->addDays(15));
        // Passport::refreshTokensExpireIn(now()->addMonth(3));
        // Passport::personalAccessTokensExpireIn(now()->addMinutes(15));

        // Passport::useTokenModel(Token::class);
        // Passport::useRefreshTokenModel(BridgeRefreshToken::class);
        // Passport::useAuthCodeModel(PassportAuthCode::class);
        // Passport::useClientModel(PassportClient::class);
        // Passport::usePersonalAccessClientModel(PassportPersonalAccessClient::class);
    }
}
