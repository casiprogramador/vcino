<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_plans', function (Blueprint $table) {
            $table->increments('id');
			$table->date('fecha_estimada');
			$table->string('referencia');
			$table->text('notas');
			$table->decimal('costo_estimado', 10, 2)->default(0);
			$table->integer('equipment_id')->unsigned();
            $table->foreign('equipment_id')->references('id')->on('equipment');
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::drop('maintenance_plans');
    }
}
