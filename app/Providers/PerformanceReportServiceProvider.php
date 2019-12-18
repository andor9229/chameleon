<?php

namespace App\Providers;

use App\Contracts\AdsReportContract;
use App\Services\Reports\Ads\AdsReport;
use App\Services\Reports\Ads\Bing\BingAdsReport;
use App\Services\Reports\Ads\Google\GoogleAdsReport;
use Illuminate\Support\ServiceProvider;

class PerformanceReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdsReportContract::class, function($app) {
            switch(request()->category) {
                case 'bing':
                    return app()->make(BingAdsReport::class);
                    break;

                case 'google':
                    return app()->make(GoogleAdsReport::class);
                    break;

                default:
                    return app()->make(AdsReport::class);
                    break;
            }
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
