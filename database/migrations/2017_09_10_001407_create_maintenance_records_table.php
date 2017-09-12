<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->increments('id');
			$table->date('fecha_realizacion');
			$table->string('tipo');
			$table->text('notas');
			$table->string('adjunto_1')->nullable();
			$table->string('adjunto_2')->nullable();
			$table->string('adjunto_3')->nullable();
			$table->decimal('costo', 10, 2)->default(0);
			$table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
			$table->integer('equipment_id')->unsigned();
            $table->foreign('equipment_id')->references('id')->on('equipment');
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
        Schema::drop('maintenance_records');
    }
}
