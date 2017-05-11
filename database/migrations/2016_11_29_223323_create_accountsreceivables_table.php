<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsreceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountsreceivables', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('gestion');
			$table->integer('periodo');
			$table->date('fecha_gestion_periodo')->nullable();
			$table->date('fecha_vencimiento');
			$table->decimal('cantidad', 10, 2);
			$table->decimal('importe_por_cobrar', 10, 2);
			$table->decimal('importe_abonado', 10, 2);
			$table->tinyInteger('cancelada');
			
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
			
			$table->integer('quota_id')->unsigned();
            $table->foreign('quota_id')->references('id')->on('quotas');
			
			$table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties');
			
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
			$table->integer('id_collection')->default(0);
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
        Schema::drop('accountsreceivables');
    }
}
