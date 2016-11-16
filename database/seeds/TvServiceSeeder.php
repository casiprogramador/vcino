<?php

use Illuminate\Database\Seeder;

class TvServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tvservices')->delete();
        $sectors = array(
            array( 'nombre' => 'TV service 1'),
			array( 'nombre' => 'TV service 2')
        );
        DB::table('tvservices')->insert($sectors);
    }
}
