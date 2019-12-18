<?php


namespace App\Services\Reports\Ads;

use App\Contracts\AdsReportContract;
use App\Repositories\AdsReport\AdsReportRepository;

class AdsReport implements AdsReportContract
{
    protected $performanceReportRepository;

    public function __construct(AdsReportRepository $performanceReportRepository)
    {
        $this->performanceReportRepository = $performanceReportRepository;
    }

    public function getReport()
    {
        return $this->performanceReportRepository->getReportForAllPlatforms();
    }
}
