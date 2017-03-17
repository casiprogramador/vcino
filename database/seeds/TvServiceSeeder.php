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
            array( 'nombre' => 'Sin especificar'),
            array( 'nombre' => 'COTAS CABLE TV'),
            array( 'nombre' => 'ENTEL S.A.'),
            array( 'nombre' => 'I.T.S. TV CABLE'),
            array( 'nombre' => 'TIGO STAR')
        );
        DB::table('tvservices')->insert($sectors);
    }
}
