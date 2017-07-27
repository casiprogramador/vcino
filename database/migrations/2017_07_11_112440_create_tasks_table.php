<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
			$table->string('titulo_tarea');
			$table->string('tipo_tarea');
			$table->string('estado_solicitud');
			$table->text('nota')->nullable();
			$table->string('medio_solicitud')->nullable();
			$table->string('prioridad')->nullable();
			$table->string('frecuencia')->nullable();
			$table->date('fecha_requerida')->nullable();
			$table->dateTime('hora_inicio')->nullable();
			$table->dateTime('hora_fin')->nullable();
			$table->decimal('costo', 10, 2)->default(0);
			$table->string('documento_1')->nullable();
			$table->string('documento_2')->nullable();
			$table->string('documento_3')->nullable();
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
