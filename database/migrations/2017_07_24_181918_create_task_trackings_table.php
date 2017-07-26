<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_trackings', function (Blueprint $table) {
            $table->increments('id');
			$table->date('fecha');
			$table->text('descripcion')->nullable();
			$table->string('adjunto')->nullable();
			$table->tinyInteger('notificar')->default(0);
			$table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');
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
        Schema::drop('task_trackings');
    }
}
