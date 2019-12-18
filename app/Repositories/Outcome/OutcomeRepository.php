<?php


namespace App\Repositories\Outcome;


use App\Models\Lead\Lead;
use App\Models\Outcome\Outcome;

class OutcomeRepository
{
    private $outcome;
    public function __construct()
    {
        $this->outcome = new Outcome();
    }

    public function insert($item)
    {
        $outcome = new Outcome();

        $outcome->id = $item->id;
        $outcome->partner = $item->partner;
        $outcome->campaign = $item->campaign;
        $outcome->buyer = $item->buyer;
        $outcome->status_name = $item->status_name;
        $outcome->fo_result_code = $item->fo_result_code;
        $outcome->fo_result_type = $item->fo_result_type;
        $outcome->fo_result_category = $item->fo_result_category;
        $outcome->fo_result_created_at = $item->fo_result_created_at;
        $outcome->fo_result_updated_at = $item->fo_result_updated_at;
        $outcome->bo_result_code = $item->bo_result_code;
        $outcome->bo_result_type = $item->bo_result_type;
        $outcome->bo_result_category = $item->bo_result_category;
        $outcome->bo_result_created_at = $item->bo_result_created_at;
        $outcome->bo_result_updated_at = $item->bo_result_updated_at;
        $outcome->ac_result_code = $item->ac_result_code;
        $outcome->ac_result_type = $item->ac_result_type;
        $outcome->ac_result_category = $item->ac_result_category;
        $outcome->ac_result_created_at = $item->ac_result_created_at;
        $outcome->ac_result_updated_at = $item->ac_result_updated_at;
        $outcome->key = $item->key;
        $outcome->tag = collect($item->tag)->toJson();
        $outcome->lead_id = $item->lead->id;
        $outcome->source_created_at = $item->created_at;
        $outcome->source_updated_at = $item->updated_at;

        if($outcome->isSetOperator() && $outcome->isNullFirstOutcomeIdOperator()) {
            $outcome->first_fo_result_code = $item->fo_result_code;
            $outcome->first_fo_result_type = $item->fo_result_type;
            $outcome->first_fo_result_category = $item->fo_result_category;
            $outcome->first_outcome_id_operator = $item->tag->id_operator;
        }

        if(! is_null($item->fo_result_type)) {
            $outcome->last_acquisition_channel = $item->lead->f11;
        }

        $outcome->save();
    }

    public function updateOutcome($item)
    {
        $outcome = Outcome::find($item->id);
        $lead = Lead::find($item->lead->id);

        $first_outcome_id_operator = NULL;
        $first_fo_result_code = NULL;
        $first_fo_result_type = NULL;
        $first_fo_result_category = NULL;

        if($outcome->isSetOperator() && $outcome->isNullFirstOutcomeIdOperator()) {
            $outcome->first_fo_result_code = $item->fo_result_code;
            $outcome->first_fo_result_type = $item->fo_result_type;
            $outcome->first_fo_result_category = $item->fo_result_category;
            $outcome->first_outcome_id_operator = $item->tag->id_operator;
        }

        $outcome->id = $item->id;
        $outcome->partner = $item->partner;
        $outcome->campaign = $item->campaign;
        $outcome->buyer = $item->buyer;
        $outcome->status_name = $item->status_name;
        $outcome->fo_result_code = $item->fo_result_code;
        $outcome->fo_result_type = $item->fo_result_type;
        $outcome->fo_result_category = $item->fo_result_category;
        $outcome->fo_result_created_at = $item->fo_result_created_at;
        $outcome->fo_result_updated_at = $item->fo_result_updated_at;
        $outcome->bo_result_code = $item->bo_result_code;
        $outcome->bo_result_type = $item->bo_result_type;
        $outcome->bo_result_category = $item->bo_result_category;
        $outcome->bo_result_created_at = $item->bo_result_created_at;
        $outcome->bo_result_updated_at = $item->bo_result_updated_at;
        $outcome->ac_result_code = $item->ac_result_code;
        $outcome->ac_result_type = $item->ac_result_type;
        $outcome->ac_result_category = $item->ac_result_category;
        $outcome->ac_result_created_at = $item->ac_result_created_at;
        $outcome->ac_result_updated_at = $item->ac_result_updated_at;
        $outcome->key = $item->key;
        $outcome->tag = collect($item->tag)->toJson();
        $outcome->lead_id = $item->lead->id;
        $outcome->source_created_at = $item->created_at;
        $outcome->source_updated_at = $item->updated_at;

        if(! is_null($item->fo_result_type && $item->partner !== $lead->first_partner_managed_lead)) {
            $outcome->last_acquisition_channel = $item->lead->f11;
        }

        $outcome->save();
    }

    public function findById($id)
    {
        return $this->outcome->find($id);
    }
    
}
