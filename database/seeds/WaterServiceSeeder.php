<?php

use Illuminate\Database\Seeder;

class WaterServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('waterservices')->delete();
        $sectors = array(
            array( 'nombre' => 'Sin especificar'),
            array( 'nombre' => 'SAGUAPAC'),
            array( 'nombre' => 'AGUAYSES'),
            array( 'nombre' => 'SEMAPA'),
            array( 'nombre' => 'EPSAS')
        );
        DB::table('waterservices')->insert($sectors);
    }
}
