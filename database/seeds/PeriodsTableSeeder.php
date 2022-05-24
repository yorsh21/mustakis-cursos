<?php

use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert([
            'id' => 1,
            'name' => 'Primer Semestre', 
            'description' => 'Primer Semestre del año 2018', 
            'start_date' => '2018-03-01',
            'end_date' => '2018-07-5',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('periods')->insert([
            'id' => 2,
            'name' => 'Vacaciones de Invierno', 
            'description' => 'Vacaciones de Invierno del año 2018', 
            'start_date' => '2018-07-5',
            'end_date' => '2018-08-5',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('periods')->insert([
            'id' => 3,
            'name' => 'Segundo Semestre', 
            'description' => 'Segundo Semestre del año 2018', 
            'start_date' => '2018-08-5',
            'end_date' => '2018-12-15',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
