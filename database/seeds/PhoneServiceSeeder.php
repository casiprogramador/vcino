<?php

use Illuminate\Database\Seeder;

class PhoneServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone_services')->delete();
        $sectors = array(
            array( 'nombre' => 'Sin especificar'),
            array( 'nombre' => 'COTAS'),
            array( 'nombre' => 'ENTEL'),
            array( 'nombre' => 'TIGO'),
            array( 'nombre' => 'VIVA')
        );
        DB::table('phone_services')->insert($sectors);
    }
}
