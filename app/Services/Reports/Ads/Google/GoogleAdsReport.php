<?php

namespace App\Services\Reports\Ads\Google;

use App\Contracts\AdsReportContract;
use App\Services\Reports\Ads\AdsReport;

class GoogleAdsReport extends AdsReport implements AdsReportContract
{
    protected $category = 'google';

    public function getReport()
    {
        return $this->performanceReportRepository->getReportForCategory($this->category);
    }
}
