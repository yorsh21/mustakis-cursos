<?php

use Illuminate\Database\Seeder;

class SchoolWorkshopCampusTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('es_ES');
    	
        for ($i=1; $i <= 30; $i++) {
        	DB::table('school_workshop_campus')->insert([
        	    'id' => $i,
        	    'campus_id' => $faker->numberBetween($min = 1, $max = 8), 
        	    'school_workshop_id' => $faker->numberBetween($min = 1, $max = 6), 
        	]);
        }
    }
}
