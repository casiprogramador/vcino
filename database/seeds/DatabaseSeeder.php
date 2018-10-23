<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(BankTableSeeder::class);
		$this->call(ElectricServiceSeeder::class);
		$this->call(InternetServiceSeeder::class);
		$this->call(PhoneServiceSeeder::class);
		$this->call(SituacionHabitacionalSeeder::class);
		$this->call(TvServiceSeeder::class);
		$this->call(WaterServiceSeeder::class);
		$this->call(RelationContactSeeder::class);
		$this->call(TypeContactSeeder::class);
		$this->call(MediaSeeder::class);*/
		
		factory(App\UserMobile::class)->create();
    }
}
