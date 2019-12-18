<?php

namespace App\Http\Controllers\PerformanceReport;

use App\Contracts\AdsReportContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerformanceReportController extends Controller
{
    public function all(AdsReportContract $performanceReport)
    {
        try {
            return $performanceReport->getReport();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
