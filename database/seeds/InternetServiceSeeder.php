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
            array( 'nombre' => 'Sin especificar'),
            array( 'nombre' => 'COTAS NET'),
            array( 'nombre' => 'AXS BOLIVIA S.A.'),
            array( 'nombre' => 'ENTEL S.A.'),
            array( 'nombre' => 'TIGO STAR')
        );
        DB::table('internetservices')->insert($sectors);
    }
}
