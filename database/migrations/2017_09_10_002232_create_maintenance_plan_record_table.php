<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancePlanRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_plans_records', function (Blueprint $table) {
            $table->increments('id');
			$table->boolean('estado')->default(true);
			$table->integer('maintenance_plan_id')->unsigned();
            $table->foreign('maintenance_plan_id')->references('id')->on('maintenance_plans');
			$table->integer('maintenance_record_id')->unsigned();
            $table->foreign('maintenance_record_id')->references('id')->on('maintenance_records');
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
        //
    }
}
