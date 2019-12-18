<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('campaign');
            $table->text('adGroup')->nullable();
            $table->text('extension')->nullable();
            $table->text('cost')->nullable();
            $table->text('leads');
            $table->text('contracts');
            $table->text('contractsBrand');
            $table->text('contractsCross');
            $table->text('cr');
            $table->text('crBrand');
            $table->text('crCross');
            $table->text('cpl')->nullable();
            $table->text('category');
            $table->boolean('is_last_daily');
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
        Schema::dropIfExists('performance_reports');
    }
}
