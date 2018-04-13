<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cuota');
            $table->string('frecuencia_pago');
            $table->string('tipo_importe');
			$table->string('forma_cobro');
            $table->decimal('importe', 10, 2);
            $table->text('notas');
            $table->tinyInteger('activa');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('type_property_id')->unsigned();
            $table->foreign('type_property_id')->references('id')->on('type_properties');
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
        Schema::drop('quotas');
    }
}
