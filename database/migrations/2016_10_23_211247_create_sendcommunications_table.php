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
