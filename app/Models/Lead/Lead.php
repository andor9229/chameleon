<?php

namespace App\Models\Lead;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $monitoredAttributes = [
        'f11',
        'f18',
    ];

    public function isNullfirstOperatorManagedLead()
    {
        return is_null($this->first_operator_managed_lead);
    }

    public function isNullfirstPartnerManagedLead()
    {
        return is_null($this->first_partner_managed_lead);
    }

    public function fieldsHasChanges()
    {
        return $this->wasChanged($this->monitoredAttributes);
    }
}
