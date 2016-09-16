<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social');
            $table->string('contacto_nombre')->nullable();
            $table->string('contacto_apellido')->nullable();
            $table->string('telefono_oficina')->nullable();
            $table->string('telefono_movil')->nullable();
            $table->string('telefono_emergencia')->nullable();
            $table->string('nombre_cheque')->nullable();
            $table->string('email')->nullable();
            $table->string('sitio_web')->nullable();
            $table->string('direccion')->nullable();
            $table->text('notas')->nullable();
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
        Schema::drop('suppliers');
    }
}
