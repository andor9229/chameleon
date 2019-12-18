<?php

namespace App\Jobs;

use App\Models\Source\PartnerSource;
use App\Services\Sources\PartnerSourceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RetrieveDataFromPartnerSource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sources = PartnerSource::where('is_active', true)->get();

        foreach ($sources as $index => $source) {
            $s = new PartnerSourceService($source);
            $s->retrieveData()->mapping()->toDatabase();
        }
    }
}
