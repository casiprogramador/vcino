<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nro');
			$table->string('nro_intecomunicador');
			$table->string('etiquetas');
			$table->string('campo_1');
			$table->string('campo_2');
			$table->text('notas');
			$table->string('codigo_electricidad');
			$table->string('codigo_agua');
			$table->string('codigo_gas');
			$table->decimal('superficie', 10, 2);
			$table->decimal('scc', 10, 2);
			$table->decimal('fit', 10, 2);
			$table->integer('nro_dormitorios');
			$table->integer('nro_banos');
			$table->string('plano')->nullable();
			$table->text('caracteristicas');
			$table->integer('orden')->default(0);
			
			$table->integer('tvservices_id')->unsigned();
            $table->foreign('tvservices_id')->references('id')->on('tvservices');
			
			$table->integer('internetservices_id')->unsigned();
            $table->foreign('internetservices_id')->references('id')->on('internetservices');
			
			$table->integer('phone_services_id')->unsigned();
            $table->foreign('phone_services_id')->references('id')->on('phone_services');
			
			$table->integer('waterservices_id')->unsigned();
            $table->foreign('waterservices_id')->references('id')->on('waterservices');
			
			$table->integer('electricservices_id')->unsigned();
            $table->foreign('electricservices_id')->references('id')->on('electricservices');
			
			$table->integer('situacion_habitacionals_id')->unsigned();
            $table->foreign('situacion_habitacionals_id')->references('id')->on('situacion_habitacionals');
			
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
        Schema::drop('properties');
    }
}
