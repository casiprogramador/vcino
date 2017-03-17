<?php

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('media')->delete();
        $data = array(
            array( 'nombre' => 'E-mail','activa' => '1'),
            array( 'nombre' => 'Teléfono móvil','activa' => '1'),
            array( 'nombre' => 'Teléfono fijo','activa' => '1'),
            array( 'nombre' => 'Texting','activa' => '1'),
            array( 'nombre' => 'Personal','activa' => '1'),
            array( 'nombre' => 'Otro','activa' => '1')
        );
        DB::table('media')->insert($data);
    }
}
