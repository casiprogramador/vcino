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
			$table->integer('nro_documento');
			$table->string('tipo_transaccion');
			$table->date('fecha_pago');
			$table->string('concepto');
			$table->string('forma_pago');
			$table->string('numero_forma_pago');
			$table->decimal('importe_credito', 10, 2)->default(0);
			$table->decimal('importe_debito', 10, 2)->default(0);
			$table->text('notas');
			$table->tinyInteger('excluir_reportes')->default(0);
			$table->tinyInteger('anulada')->default(0);
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
