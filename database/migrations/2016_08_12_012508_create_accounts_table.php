<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
			$table->decimal('balance_inicial', 10, 2)->default(0);
            $table->string('nro_cuenta')->nullable();
            $table->enum('tipo_cuenta', ['Caja de Ahorro', 'Cuenta Corriente','Efectivo']);
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->string('nombre_cuentahabiente')->nullable();
            $table->text('nota');
            $table->tinyInteger('activa');
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
        Schema::drop('accounts');
    }
}
