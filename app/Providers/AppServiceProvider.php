<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        $this->app->singleton('DrinksApiClient', function () {
            $client = new \GuzzleHttp\Client([
                'base_uri' => 'https://the-cocktail-db3.p.rapidapi.com/',
                'http_errors' => false,
                'headers' => [
                    'accept' => 'application/json',
                    'x-rapidapi-host' => config('client.client_host'),
                    'x-rapidapi-key' => config('client.client_key')
                ]
            ]);

            return $client;
        });
    }
}
