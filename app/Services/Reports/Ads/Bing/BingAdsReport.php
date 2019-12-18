<?php

namespace App\Services\Reports\Ads\Bing;

use App\Contracts\AdsReportContract;
use App\Services\Reports\Ads\AdsReport;

class BingAdsReport extends AdsReport implements AdsReportContract
{
    protected $category = 'bing';

    public function getReport()
    {
        return $this->performanceReportRepository->getReportForCategory($this->category);
    }

}
