<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendalertpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendalertpayments', function (Blueprint $table) {
            $table->increments('id');
			$table->string('asunto');
			$table->string('nota');
			$table->integer('limite_periodo');
			$table->integer('limite_gestion');
			$table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties');
			$table->decimal('importe_total', 10, 2);
			$table->string('id_cuentas_pagar');
			$table->string('nombre_cuotas');
			$table->string('categoria_cuotas');
			$table->string('importes');
			$table->string('frecuencias');
			$table->string('fecha_vencimientos');
			$table->string('periodos');
			$table->string('gestiones');
			$table->string('correos');
			$table->dateTime('fecha_envio');
			$table->tinyInteger('enviado')->default('0');
			
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('sendalertpayments');
    }
}
