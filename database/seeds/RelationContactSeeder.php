<?php

use Illuminate\Database\Seeder;

class RelationContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relationcontacts')->delete();
        $data = array(
            array( 'nombre' => 'Titular','activa' => '1'),
			array( 'nombre' => 'Esposa/ Esposo','activa' => '1'),
			array( 'nombre' => 'Hija/ Hijo','activa' => '1'),
			array( 'nombre' => 'Familiar','activa' => '1'),
			array( 'nombre' => 'Personal de servicio','activa' => '1'),
			array( 'nombre' => 'Contacto administrativo','activa' => '1'),
			array( 'nombre' => 'Contacto de emergencia','activa' => '1'),
			array( 'nombre' => 'Otro','activa' => '1'),
        );
        DB::table('relationcontacts')->insert($data);
    }
}
