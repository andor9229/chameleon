<?php

namespace App\Observers;


use App\Events\LeadAttributesChanged;
use App\Models\Lead\Lead;

class LeadObserver
{
    /**
     * Handle the lead "updated" event.
     *
     * @param  Lead  $lead
     * @return void
     */
    public function updated(Lead $lead)
    {
        if($lead->fieldsHasChanges()) {
            event(new LeadAttributesChanged($lead));
        }
    }
}
