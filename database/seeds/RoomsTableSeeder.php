<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        for ($i=1; $i <= 40; $i++) {
        	DB::table('rooms')->insert([
        	    'id' => $i,
        	    'number' => $faker->numberBetween($min = 1, $max = 60), 
        	    'capacity' => $faker->numberBetween($min = 20, $max = 120), 
        	    'campus_id' => $faker->numberBetween($min = 1, $max = 8),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
        }
    }
}
