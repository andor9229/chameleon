<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('source_lead_id');
            $table->text('name')->nullable();
            $table->text('surname')->nullable();
            $table->text('sex')->nullable();
            $table->bigInteger('phone');
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('zip')->nullable();
            $table->text('tax_code')->nullable();
            $table->text('vat')->nullable();
            $table->text('owner')->nullable();
            $table->text('source_type_name')->nullable();
            $table->text('supplier_name')->nullable();
            $table->text('privacy_1')->nullable();
            $table->text('privacy_2')->nullable();
            $table->text('privacy_3')->nullable();
            $table->text('referral')->nullable();
            $table->text('referer')->nullable();
            $table->text('keywords')->nullable();
            $table->text('domain_source')->nullable();
            $table->text('batch_import_id')->nullable();
            $table->text('f1')->nullable();
            $table->text('f2')->nullable();
            $table->text('f3')->nullable();
            $table->text('f4')->nullable();
            $table->text('f5')->nullable();
            $table->text('f6')->nullable();
            $table->text('f7')->nullable();
            $table->text('f8')->nullable();
            $table->text('f9')->nullable();
            $table->text('f10')->nullable();
            $table->text('f11')->nullable();
            $table->text('f12')->nullable();
            $table->text('f13')->nullable();
            $table->text('f14')->nullable();
            $table->text('f15')->nullable();
            $table->text('f16')->nullable();
            $table->text('f17')->nullable();
            $table->text('f18')->nullable();
            $table->text('f19')->nullable();
            $table->text('client_ip')->nullable();
            $table->text('idcontattowonder')->nullable();
            $table->text('idattivitawonder')->nullable();
            $table->text('idserviziowonder')->nullable();
            $table->text('idtipoattivitawonder')->nullable();
            $table->text('lead_token')->nullable();
            $table->text('first_operator_managed_lead')->nullable();
            $table->text('first_partner_managed_lead')->nullable();
            $table->text('source_created_at')->nullable();
            $table->text('source_updated_at')->nullable();
            $table->text('source_deleted_at')->nullable();
            $table->text('first_acquisition_channel')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
