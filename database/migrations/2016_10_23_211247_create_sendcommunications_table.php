<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendcommunicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendcommunications', function (Blueprint $table) {
            $table->increments('id');
			$table->string('remitente');
			$table->string('dirigido');
			$table->string('propiedad')->nullable();
			$table->string('destinatario')->nullable();
			$table->string('correos')->nullable();
			$table->tinyInteger('enviado')->default('0');
			$table->integer('communication_id')->unsigned();
            $table->foreign('communication_id')->references('id')->on('communications');
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
        Schema::drop('sendcommunications');
    }
}
