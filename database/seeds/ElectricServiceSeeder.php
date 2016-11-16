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
            array( 'nombre' => 'Electric service 1'),
			array( 'nombre' => 'Electric service 2')
        );
        DB::table('electricservices')->insert($sectors);
    }
}
