<?php

namespace Tests\Feature\SourceLog;

use App\Events\LeadAttributesChanged;
use App\Models\Lead\Lead;
use App\Repositories\Lead\LeadRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class LeadLog extends SourceLog
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function insertLead()
    {
        Event::fake([LeadAttributesChanged::class]);
        $leadRepository = new LeadRepository();
        foreach ($this->outcomes as $index => $outcome) {
            try {
                if (! is_null($leadRepository->findById($outcome->lead->id))) {
                    $lead = $leadRepository->updateLead($outcome);
                } else {
                    $leadRepository->insert($outcome);
                }
            } catch (\Exception $e) {

            }
        }

        $this->assertCount(1, Lead::all());
        Event::assertDispatched(LeadAttributesChanged::class);
    }

    /** @test */
    public function anUpdateLeadFireAUpdateAPerformanceReport()
    {
        Event::fake([LeadAttributesChanged::class]);
        $leadRepository = new LeadRepository();
        foreach ($this->outcomes as $index => $outcome) {
            try {
                if (! is_null($leadRepository->findById($outcome->lead->id))) {
                    $lead = $leadRepository->updateLead($outcome);
                } else {
                    $leadRepository->insert($outcome);
                }
            } catch (\Exception $e) {

            }
        }

        Event::assertDispatched(LeadAttributesChanged::class);
    }
}
