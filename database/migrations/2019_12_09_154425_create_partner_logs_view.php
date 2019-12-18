<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerLogsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            CREATE OR REPLACE VIEW partner_logs_view AS
            SELECT
                partner,
                campaign,
                buyer,
                status_name,
                fo_result_code,
                fo_result_type,
                fo_result_category,
                fo_result_created_at,
                fo_result_updated_at,
                first_outcome_id_operator,
                first_operator_managed_lead,
                phone,
                f4,
                f5,
                supplier_name,
                leads.created_at
            FROM outcomes
            INNER JOIN leads ON outcomes.lead_id = leads.id
        ");
    }
}
