<?php

use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        for ($i=1; $i <= 8; $i++) {
        	DB::table('campus')->insert([
        	    'id' => $i,
        	    'name' => $faker->state, 
        	    'address' => $faker->address, 
        	    'user_id' => 2,
        	    'commune_id' => $faker->numberBetween($min = 1, $max = 346),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
        }
    }
}
