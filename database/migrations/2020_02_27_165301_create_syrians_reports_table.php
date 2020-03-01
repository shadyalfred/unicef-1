<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyriansReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syrians_reports', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('governorate_id', 64)->references('id')->on('governorates'); // Foreign key

            $table->integer('males_under_5')->nullable();
            $table->integer('males_from_5_to_15')->nullable();
            $table->integer('females_under_5')->nullable();
            $table->integer('females_from_5_to_15')->nullable();
            $table->integer('pregnancy_visits')->nullable();
            $table->integer('endangered_pregnancies')->nullable();
            $table->integer('other_visits')->nullable();
            $table->integer('males_above_15_visits')->nullable();

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
        Schema::dropIfExists('syrians_reports');
    }
}
