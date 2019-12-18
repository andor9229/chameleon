<?php

namespace Tests\Feature\OutcomeLogTest;

use App\Events\LeadAttributesChanged;
use App\Models\Lead\Lead;
use App\Models\Outcome\Outcome;
use App\Repositories\Lead\LeadRepository;
use App\Repositories\Outcome\OutcomeRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use Tests\Feature\SourceLog\SourceLog;

class OutcomeLog extends SourceLog
{
    use DatabaseMigrations;

    /** @test */
    public function insertOutcomeFromOurCampaign()
    {
        Event::fake([LeadAttributesChanged::class]);

        $outcomeRepository = new OutcomeRepository();

        foreach ($this->outcomes as $index => $outcome) {
            $outcomeRepository->insert($outcome);
        }

        Event::assertNotDispatched(LeadAttributesChanged::class);
        $this->assertCount(2, Outcome::all());
    }

    /** @test */
    public function insertOutcomeWithMapping()
    {
        Event::fake([LeadAttributesChanged::class]);

        $this->mapping();

        $outcomeRepository = new OutcomeRepository();
        $leadRepository = new LeadRepository();

        foreach ($this->outcomesForMapping as $index => $outcome) {
            $outcomeRepository->insert($outcome);
            if (! is_null($leadRepository->findById($outcome->lead->id))) {
                $lead = $leadRepository->updateLead($outcome);
            } else {
                $leadRepository->insert($outcome);
            }
        }

        Event::assertDispatched(LeadAttributesChanged::class);
        $this->assertCount(2, Outcome::all());
        $this->assertTrue(Outcome::first()->partner === 'prezzogiusto');
        $this->assertTrue(Lead::first()->name === 'CLAUDIO');
    }

    private function mapping()
    {
        $mapping = config('dashboard.mapping');

        if(is_null($mapping) || ! $mapping['active']) {
            return $this;
        }

        $data = new Collection();
        collect($this->outcomesForMapping)->each(function($outcome, $i) use ($mapping, $data) {
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

        $this->outcomesForMapping = $data->map(function($d) {
            $d['lead'] = (object) $d['lead']->toArray();
            return (object) $d->toArray();
        })->toArray();

        return $this;
    }
}
