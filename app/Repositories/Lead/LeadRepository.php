<?php


namespace App\Repositories\Lead;

use App\Models\Lead\Lead;
use App\Models\Outcome\Outcome;

class LeadRepository
{
    /**
     * @var Lead
     */
    private $lead;

    public function __construct()
    {
        $this->lead = new Lead();
    }

    public static function insert($outcome)
    {
        $item = $outcome->lead;
        $outcomeModel = new Outcome();

        $lead = new Lead();

        $lead->id = $item->id;
        $lead->source_lead_id = $item->id;
        $lead->name = $item->name;
        $lead->surname = $item->surname;
        $lead->sex = $item->sex;
        $lead->phone = $item->phone;
        $lead->email = $item->email;
        $lead->address = $item->address;
        $lead->city = $item->city;
        $lead->state = $item->state;
        $lead->zip = $item->zip;
        $lead->tax_code = $item->tax_code;
        $lead->vat = $item->vat;
        $lead->owner = $item->owner;
        $lead->source_type_name = $item->source_type_name;
        $lead->supplier_name = $item->supplier_name;
        $lead->privacy_1 = $item->privacy_1;
        $lead->privacy_2 = $item->privacy_2;
        $lead->privacy_3 = $item->privacy_3;
        $lead->referral = $item->referral;
        $lead->referer = $item->referer;
        $lead->keywords = $item->keywords;
        $lead->domain_source = $item->domain_source;
        $lead->batch_import_id = $item->batch_import_id;
        $lead->created_at = $item->created_at;
        $lead->updated_at = $item->updated_at;
        $lead->f1 = $item->f1 ? $item->f1 : null;
        $lead->f2 = $item->f2 ? $item->f2 : null;
        $lead->f3 = $item->f3 ? $item->f3 : null;
        $lead->f4 = $item->f4 ? $item->f4 : null;
        $lead->f5 = $item->f5 ? $item->f5 : null;
        $lead->f6 = $item->f6 ? $item->f6 : null;
        $lead->f7 = $item->f7 ? $item->f7 : null;
        $lead->f8 = $item->f8 ? $item->f8 : null;
        $lead->f9 = $item->f9 ? $item->f9 : null;
        $lead->f10 = $item->f10 ? $item->f10 : null;
        $lead->f11 = $item->f11 ? $item->f11 : null;
        $lead->f12 = $item->f12 ? $item->f12 : null;
        $lead->f13 = $item->f13 ? $item->f13 : null;
        $lead->f14 = $item->f14 ? $item->f14 : null;
        $lead->f15 = $item->f15 ? $item->f15 : null;
        $lead->f16 = $item->f16 ? $item->f16 : null;
        $lead->f17 = $item->f17 ? $item->f17 : null;
        $lead->f18 = $item->f18 ? $item->f18 : null;
        $lead->f19 = $item->f19 ? $item->f19 : null;
        $lead->lead_token = $item->lead_token;
        $lead->client_ip = $item->client_ip;
        $lead->idcontattowonder = $item->idcontattowonder;
        $lead->idattivitawonder = $item->idattivitawonder;
        $lead->idserviziowonder = $item->idserviziowonder;
        $lead->idtipoattivitawonder = $item->idtipoattivitawonder;
        $lead->source_created_at = $item->created_at;
        $lead->source_updated_at = $item->updated_at;
        $lead->first_acquisition_channel = $item->f11;

        if($outcomeModel->isSetOperator() && $lead->isNullfirstOperatorManagedLead()) {
            $lead->first_operator_managed_lead = $outcome->tag->id_operator;
        }

        if($outcomeModel->isSetPartner() && $lead->isNullfirstPartnerManagedLead()) {
            $lead->first_partner_managed_lead = $outcome->partner;
        }

        $lead->save();
    }

    public static function updateLead($outcome)
    {
         $item = $outcome->lead;
            $outcomeModel = new Outcome();
            $lead = Lead::find($item->id);
            $lead->f11 = 'asd';
            if ($outcomeModel->isSetOperator() && $lead->isNullfirstOperatorManagedLead()) {
                $lead->first_operator_managed_lead = $outcome->tag->id_operator;
            }
            if ($outcomeModel->isSetPartner() && $lead->isNullfirstPartnerManagedLead()) {
                $lead->first_partner_managed_lead = $outcome->partner;
            }
            $lead->id = $item->id;
            $lead->source_lead_id = $item->id;
            $lead->name = $item->name;
            $lead->surname = $item->surname;
            $lead->sex = $item->sex;
            $lead->phone = $item->phone;
            $lead->email = $item->email;
            $lead->address = $item->address;
            $lead->city = $item->city;
            $lead->state = $item->state;
            $lead->zip = $item->zip;
            $lead->tax_code = $item->tax_code;
            $lead->vat = $item->vat;
            $lead->owner = $item->owner;
            $lead->source_type_name = $item->source_type_name;
            $lead->supplier_name = $item->supplier_name;
            $lead->privacy_1 = $item->privacy_1;
            $lead->privacy_2 = $item->privacy_2;
            $lead->privacy_3 = $item->privacy_3;
            $lead->referral = $item->referral;
            $lead->referer = $item->referer;
            $lead->keywords = $item->keywords;
            $lead->domain_source = $item->domain_source;
            $lead->batch_import_id = $item->batch_import_id;
            $lead->created_at = $item->created_at;
            $lead->updated_at = $item->updated_at;
            $lead->f1 = $item->f1;
            $lead->f2 = $item->f2;
            $lead->f3 = $item->f3;
            $lead->f4 = $item->f4;
            $lead->f5 = $item->f5;
            $lead->f6 = $item->f6;
            $lead->f7 = $item->f7;
            $lead->f8 = $item->f8;
            $lead->f9 = $item->f9;
            $lead->f10 = $item->f10;
            $lead->f11 = 'asd';
            $lead->f12 = $item->f12;
            $lead->f13 = $item->f13;
            $lead->f14 = $item->f14;
            $lead->f15 = $item->f15;
            $lead->f16 = $item->f16;
            $lead->f17 = $item->f17;
            $lead->f18 = $item->f18;
            $lead->f19 = $item->f19;
            $lead->lead_token = $item->lead_token;
            $lead->client_ip = $item->client_ip;
            $lead->idcontattowonder = $item->idcontattowonder;
            $lead->idattivitawonder = $item->idattivitawonder;
            $lead->idserviziowonder = $item->idserviziowonder;
            $lead->idtipoattivitawonder = $item->idtipoattivitawonder;
            $lead->source_created_at = $item->created_at;
            $lead->source_updated_at = $item->updated_at;
            if (is_null($lead->first_acquisition_channel)) {
                $lead->first_acquisition_channel = $item->f11;
            }
            if ($outcomeModel->isSetOperator() && $lead->isNullfirstOperatorManagedLead()) {
                $lead->first_operator_managed_lead = $outcome->tag->id_operator;;
            }
            $lead->save();
            return $lead;
    }

    public function findById($id)
    {
        return $this->lead->find($id);
    }

}
