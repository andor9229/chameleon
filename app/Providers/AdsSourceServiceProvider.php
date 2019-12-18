<?php

namespace App\Providers;

use App\Contracts\AdsSourceGateway;
use App\Services\Sources\Ads\GoogleAdsAdGroupGateway;
use App\Services\Sources\SourceContract;
use Illuminate\Support\ServiceProvider;

class AdsSourceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SourceContract::class, function($app) {
            return new GoogleAdsAdGroupGateway();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
