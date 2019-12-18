<?php


namespace App\Services\Sources;

use App\Models\Source\PartnerSource;
use App\Repositories\Lead\LeadRepository;
use App\Repositories\Outcome\OutcomeRepository;
use Illuminate\Support\Collection;

class PartnerSourceService implements SourceContract
{
    /**
     * @var PartnerSource
     */
    private $source;

    private $data;

    private $outcomeRepository;

    private $leadRepository;

    public function __construct(PartnerSource $source)
    {
        $this->source = $source;
        $this->outcomeRepository = new OutcomeRepository();
        $this->leadRepository = new LeadRepository();
    }

    public function retrieveData()
    {
        $this->data = json_decode(
            resolve('client')->get($this->source->getAttribute('path'),
                [
                    'headers' => $this->source->getAttribute('header')
                ]
            )->getBody()
        );

        return $this;
    }

    public function mapping()
    {
        $mapping = config('dashboard.mapping');

        if(is_null($mapping) || ! $mapping['active']) {
            return $this;
        }

        $data = new Collection();
        collect($this->data)->each(function($outcome, $i) use ($mapping, $data) {
            $data->put($i, new Collection());
            foreach ($mapping['fields'] as $index => $item) {
                if($index !== 'lead') {
                    $data[$i]->put($index, $outcome->{$item});
                }
            }
            $data[$i]->put('lead', new Collection());
            foreach ($mapping['fields']['lead'] as $index => $item) {
                $data[$i]['lead']->put($index, $outcome->lead->{$item});
            }
        });

        $this->data = $data->map(function($d) {
            $d['lead'] = (object) $d['lead']->toArray();
            return (object) $d->toArray();
        })->toArray();

        return $this;
    }

    public function toDatabase()
    {
        foreach ($this->data as $index => $outcome) {
            try {
                if ($this->outcomeRepository->findById($outcome->id)->count()) {
                    $this->outcomeRepository->updateOutcome($outcome);
                } else {
                    $this->outcomeRepository->insert($outcome);
                }

                if (! is_null($this->leadRepository->findById($outcome->lead->id))) {
                    $lead = $this->leadRepository->updateLead($outcome);
                } else {
                    $this->leadRepository->insert($outcome);
                }
            } catch (\Exception $e) {

            }
        }
    }
}
