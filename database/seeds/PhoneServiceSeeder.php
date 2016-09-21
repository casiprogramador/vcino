<?php

use Illuminate\Database\Seeder;

class PhoneServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone_services')->delete();
        $sectors = array(
            array( 'nombre' => 'Phone service 1'),
			array( 'nombre' => 'Phone service 2')
        );
        DB::table('phone_services')->insert($sectors);
    }
}
