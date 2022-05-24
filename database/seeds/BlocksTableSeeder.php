<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('es_ES');
    	
        for ($i=1; $i <= 24; $i++) {
        	DB::table('blocks')->insert([
        	    'id' => $i,
        	    'description' => $faker->text, 
        	    'evaluation_name' => $faker->userName, 
        	    'evaluation_Type' => $faker->state,
        	    'school_workshop_id' => $faker->numberBetween($min = 1, $max = 3),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
        }
    }
}
