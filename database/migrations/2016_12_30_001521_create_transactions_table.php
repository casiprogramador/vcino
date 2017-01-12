<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nro_documento');
			$table->string('id_propiedad');
			$table->string('id_contacto');
			$table->string('concepto');
			$table->string('cuenta');
			$table->string('forma_pago');
			$table->date('fecha_cobro');
			$table->decimal('importe', 10, 2);
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
        Schema::drop('transactions');
    }
}
