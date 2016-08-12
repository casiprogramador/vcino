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
            array( 'nombre' => 'Sin Banco'),
            array( 'nombre' => 'Banco BISA'),
            array( 'nombre' => 'Banco de Crédito BCP'),
            array( 'nombre' => 'Banco Económico'),
            array( 'nombre' => 'Banco Ganadero'),
            array( 'nombre' => 'Banco Mercantil Santa Cruz'),
            array( 'nombre' => 'Banco Nacional de Bolivia'),
            array( 'nombre' => 'Banco Unión'),
            array( 'nombre' => 'Mi banco no aparece en la lista'),
        );
        DB::table('banks')->insert($sectors);
    }
}
