<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instalacion');
            $table->text('descripcion');
            $table->decimal('costo', 10, 2);
            $table->tinyInteger('requiere_reserva');
            $table->tinyInteger('reserva_deuda');
            $table->string('dias_permitidos');
            $table->time('hora_dia_semana_hasta');
            $table->time('hora_fin_de_semana_hasta');
            $table->text('normas');
            $table->string('reglamento')->nullable();
            $table->string('fotografia_principal');
            $table->string('fotografia_1')->nullable();
            $table->string('fotografia_2')->nullable();
            $table->string('fotografia_3')->nullable();
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
        Schema::drop('installations');
    }
}
