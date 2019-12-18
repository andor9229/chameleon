<?php


namespace App\Services\GoogleAds;


use Edujugon\GoogleAds\GoogleAds;

class GoogleAdsService
{
    private $session;
    private $during;

    //TODO crud
    private static $REPORT_TYPE_TO_DEFAULT_SELECTED_FIELDS = [
        'ADGROUP_PERFORMANCE_REPORT' => [
            'AdGroupName',
            'CampaignName',
            'Cost',
            'Impressions',
            'Clicks'
        ],
        'ACCOUNT_PERFORMANCE_REPORT' => [
            'CampaignName',
            'Cost',
            'SearchImpressionShare'
        ],
    ];


    /**
     * GoogleAdsService constructor.
     * @param $clientCustomerId
     * @param $during
     */
    public function __construct($data)
    {
        $this->session = new GoogleAds();
        $this->session->session([
            'clientCustomerId' => $data['clientCustomerId']
        ]);
        $this->during = $data['during'];
    }

    public function getAdgroupPerformanceReport()
    {
        $this->report = $this->session->report()
            ->from('ADGROUP_PERFORMANCE_REPORT')
            ->during(normalizeDateForGoogleAds($this->during[0]), normalizeDateForGoogleAds($this->during[1]))
            ->select(self::$REPORT_TYPE_TO_DEFAULT_SELECTED_FIELDS['ADGROUP_PERFORMANCE_REPORT'])
            ->getAsObj();

        return $this->report->result->toArray();
    }

    public function getAccountPerformanceReport()
    {
        $this->report = $this->session->report()
            ->from('ACCOUNT_PERFORMANCE_REPORT')
            ->during(normalizeDateForGoogleAds($this->during[0]), normalizeDateForGoogleAds($this->during[1]))
            ->select(self::$REPORT_TYPE_TO_DEFAULT_SELECTED_FIELDS['ACCOUNT_PERFORMANCE_REPORT'])
            ->getAsObj();

        return $this->report->result->toArray();
    }

}
