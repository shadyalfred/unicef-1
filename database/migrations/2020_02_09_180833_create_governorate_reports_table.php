<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernorateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('governorate_reports', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('governorate_id', 64)->references('id')->on('governorates'); // Foreign key

            $table->integer('males_under_5');
            $table->integer('males_from_5_to_15');
            $table->integer('females_under_5');
            $table->integer('females_from_5_to_15');
            $table->integer('pregnancy_visits');
            $table->integer('endangered_pregnancies');
            $table->integer('other_visits');
            $table->integer('males_above_15_visits');

            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gorvernorate_reports');
    }
}
