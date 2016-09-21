<?php

use Illuminate\Database\Seeder;

class SituacionHabitacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situacion_habitacionals')->delete();
        $sectors = array(
            array( 'nombre' => 'Habitada'),
			array( 'nombre' => 'Alquilada'),
			array( 'nombre' => 'Deshabitada')
        );
        DB::table('situacion_habitacionals')->insert($sectors);
    }
}
