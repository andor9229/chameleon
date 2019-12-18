<?php


namespace App\Repositories\AdsReport;


use App\Models\PerformanceReport\PerformanceReport;

class AdsReportRepository
{
    /**
     * @var PerformanceReport
     */
    private $performanceReport;
    private $from;
    private $to;
    private $isLastDaily;

    public function __construct(PerformanceReport $performanceReport)
    {
        $this->performanceReport = $performanceReport;
        $this->from = request()->from;
        $this->to = request()->to;
        $this->isLastDaily = !! request()->has('isLastDaily');
    }

    public function getReportForAllPlatforms()
    {
        $this->performanceReport = $this->performanceReport->select('campaign')
            ->selectRaw("
                SUM(cost) AS cost
            ")
            ->groupBy('campaign');

        return $this->get();

    }

    public function getReportForCategory($category)
    {
        $this->performanceReport = $this->performanceReport
            ->select('campaign')
            ->selectRaw("
                    SUM(cost) AS cost
                ")
            ->where('category', $category)
            ->groupBy('campaign');

        return $this->get();
    }

    public function storeReportForCategory($category, $report)
    {
        $report = $report->map(function($row) use ($category){
            $row->category = $category;
            return $row;
        });

        $this->performanceReport->create($report);
    }

    /**
     * @return mixed
     */
    private function get()
    {
        $this->filterByCreatedAt();

        $this->filterByIsLast();

        return $this->performanceReport->get();
    }

    private function filterByIsLast(): void
    {
        if ($this->isLastDaily) {
            $this->performanceReport = $this->performanceReport->where('is_last_daily', $this->isLastDaily);
        }
    }

    private function filterByCreatedAt(): void
    {
        if (!is_null($this->from) && !is_null($this->to)) {
            $this->performanceReport = $this->performanceReport->whereBetween('created_at', [$this->from . ' 00:00:00', $this->to . ' 23:59:59']);
        }
    }
}
