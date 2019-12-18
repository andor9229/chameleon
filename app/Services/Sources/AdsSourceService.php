<?php


namespace App\Services\Sources;

use App\Models\Source\AdsSource;

class AdsSourceService implements SourceContract
{
    private $data;
    /**
     * @var AdsSource
     */
    private $adsSource;

    public function __construct(AdsSource $adsSource)
    {

        $this->adsSource = $adsSource;
    }

    public function retrieveData()
    {
        $gateway = new $this->gateway->class($this->adsSource->config);
        $this->data = $gateway->{$this->gateway->method}();

        return $this;
    }

    public function toDatabase()
    {
       return $this->gateway->database->create($this->data);
    }
}
