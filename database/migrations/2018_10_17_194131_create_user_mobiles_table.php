<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_mobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
			$table->string('apellido');
			$table->integer('nro_movil');
            $table->string('email')->unique();
            $table->string('password');
			$table->string('sistema');
            $table->tinyInteger('estado')->default(1);
            
			$table->string('api_token')->unique();
			$table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
			$table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties');
			$table->integer('typecontact_id')->unsigned();
            $table->foreign('typecontact_id')->references('id')->on('typecontacts');
			
			$table->rememberToken();
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
        Schema::drop('user_mobiles');
    }
}
