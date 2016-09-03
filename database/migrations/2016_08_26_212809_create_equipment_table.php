<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('equipo');
            $table->string('tipo_equipo');
            $table->string('ubicacion');
            $table->date('fecha_instalacion');
            $table->smallInteger('vida');
            $table->smallInteger('garantia');
            $table->smallInteger('mantenimiento');
            $table->text('notas');
            $table->string('fotografia_1');
            $table->string('fotografia_2');
            $table->string('fotografia_3');
            $table->string('documento');
            $table->tinyInteger('activa');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
        Schema::drop('equipment');
    }
}
