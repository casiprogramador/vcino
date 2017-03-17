<?php

use Illuminate\Database\Seeder;

class TypeContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typecontacts')->delete();
        $data = array(
            array( 'nombre' => 'Propietario','activa' => '1'),
            array( 'nombre' => 'Inquilino','activa' => '1'),
        );
        DB::table('typecontacts')->insert($data);
    }
}
