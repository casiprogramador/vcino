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
            array( 'nombre' => 'Water service 1'),
			array( 'nombre' => 'Water service 2')
        );
        DB::table('waterservices')->insert($sectors);
    }
}
