<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nombre');
			$table->string('apellido');
			
			$table->string('telefono_movil')->nullable();
			$table->string('telefono_domicilio')->nullable();
			$table->string('telefono_oficina')->nullable();
			
			$table->string('email');
			$table->string('email_alterno')->nullable();
			
			$table->string('direccion')->nullable();
			
			$table->string('fotografia');
			
			$table->string('profesion')->nullable();
			
			$table->string('nacionalidad')->nullable();
			
			$table->string('correspondencia');
			
			$table->tinyInteger('miembro_directorio')->default('0');
			
			$table->tinyInteger('mostrar_datos')->default('0');
			
			$table->text('notas');
			
			$table->tinyInteger('activa')->default('0');
			
			$table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties');
			
			$table->integer('typecontact_id')->unsigned();
            $table->foreign('typecontact_id')->references('id')->on('typecontacts');
			
			$table->integer('relationcontact_id')->unsigned();
            $table->foreign('relationcontact_id')->references('id')->on('relationcontacts');
			
			$table->integer('media_id')->unsigned();
            $table->foreign('media_id')->references('id')->on('media');
			
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
        Schema::drop('contacts');
    }
}
