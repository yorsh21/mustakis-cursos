<?php

use Illuminate\Database\Seeder;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('es_ES');
    	
        for ($i=1; $i <= 60; $i++) {
        	DB::table('materials')->insert([
        	    'id' => $i,
        	    'name' => $faker->domainWord, 
        	    'file' => 'prueba.pdf', 
        	    'general' => $faker->numberBetween($min = 0, $max = 1), 
        	    'block_id' => $faker->numberBetween($min = 1, $max = 24),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
        }
    }
}
