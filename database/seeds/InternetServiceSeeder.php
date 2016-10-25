<?php

use Illuminate\Database\Seeder;

class InternetServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('internetservices')->delete();
        $sectors = array(
            array( 'nombre' => 'Internet service 1'),
			array( 'nombre' => 'Internet service 2')
        );
        DB::table('internetservices')->insert($sectors);
    }
}
