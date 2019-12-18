<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('partner')->nullable();
            $table->text('campaign')->nullable();
            $table->text('buyer')->nullable();
            $table->text('status_name')->nullable();
            $table->text('fo_result_code')->nullable();
            $table->text('fo_result_type')->nullable();
            $table->text('fo_result_category')->nullable();
            $table->text('fo_result_created_at')->nullable();
            $table->text('fo_result_updated_at')->nullable();
            $table->text('first_fo_result_code')->nullable();
            $table->text('first_fo_result_type')->nullable();
            $table->text('first_fo_result_category')->nullable();
            $table->text('first_outcome_id_operator')->nullable();
            $table->text('bo_result_code')->nullable();
            $table->text('bo_result_type')->nullable();
            $table->text('bo_result_category')->nullable();
            $table->text('bo_result_created_at')->nullable();
            $table->text('bo_result_updated_at')->nullable();
            $table->text('ac_result_code')->nullable();
            $table->text('ac_result_type')->nullable();
            $table->text('ac_result_category')->nullable();
            $table->text('ac_result_created_at')->nullable();
            $table->text('ac_result_updated_at')->nullable();
            $table->text('key')->nullable();
            $table->json('tag')->nullable();
            $table->text('last_acquisition_channel')->nullable();
            $table->text('source_created_at')->nullable();
            $table->text('source_updated_at')->nullable();
            $table->bigInteger('lead_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outcomes');
    }
}
