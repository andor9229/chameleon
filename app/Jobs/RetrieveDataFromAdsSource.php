<?php

namespace App\Jobs;

use App\Contracts\AdsSourceGateway;
use App\Services\GoogleAds\GoogleAdsService;
use App\Services\Sources\AdsSourceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RetrieveDataFromAdsSource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $sources = [
            [
                'name' => 'google',
                'class' => GoogleAdsService::class,
                'method' => 'getAdgroupPerformanceReport',
                'during' => [now()->toDateString(), now()->toDateString()],
                'data' => 'settings'
            ]
        ];

        foreach ($sources as $index => $source) {
            $s = new AdsSourceService($source);
            $s->retrieveData()->toDatabase();
        }
    }
}
