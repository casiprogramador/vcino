<?php

use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->delete();
        $sectors = array(
            array( 'nombre' => 'Sin especificar'),
            array( 'nombre' => 'Banco BISA S.A.'),
            array( 'nombre' => 'Banco Económico S.A.'),
            array( 'nombre' => 'Banco FASSIL S.A.'),
            array( 'nombre' => 'Banco FIE S.A.'),
            array( 'nombre' => 'Banco Fortaleza S.A.'),
            array( 'nombre' => 'Banco Ganadero S.A.'),
            array( 'nombre' => 'Banco Los Andes Procredit S.A.'),
            array( 'nombre' => 'Banco Mercantil Santa Cruz S.A.'),
            array( 'nombre' => 'Banco Nacional de Bolivia S.A.'),
            array( 'nombre' => 'Banco Solidario S.A.'),
            array( 'nombre' => 'Banco Unión S.A.'),
            array( 'nombre' => 'Banco de Crédito de Bolivia S.A.'),
            array( 'nombre' => 'Mi banco no aparece en la lista'),
        );
        DB::table('banks')->insert($sectors);
    }
}
