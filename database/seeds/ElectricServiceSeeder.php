<?php

use Illuminate\Database\Seeder;

class ElectricServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('electricservices')->delete();
        $sectors = array(
            array( 'nombre' => 'Sin especificar'),
            array( 'nombre' => 'C.R.E.'),
            array( 'nombre' => 'ELFEC'),
            array( 'nombre' => 'DELAPAZ')
        );
        DB::table('electricservices')->insert($sectors);
    }
}
