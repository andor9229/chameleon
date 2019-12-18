<?php

namespace App\Models\Outcome;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    public function isSetOperator()
    {
        return ! is_null($this->tag) &&
            property_exists($this->tag, 'id_operator') &&
            (! is_null($this->tag->id_operator) || $this->tag->id_operator !== '');
    }

    public function isSetPartner()
    {
        return (! is_null($this->partner) || ! empty($this->partner));
    }

    public function isNullFirstOutcomeIdOperator()
    {
        return  is_null($this->first_outcome_id_operator);
    }
}
