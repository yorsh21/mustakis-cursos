<?php

use Illuminate\Database\Seeder;

class SchoolWorkshopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_workshops')->insert([
            'id' => 1,
            'name' => 'Robotica 1',
            'description' => 'Taller dictado los primeros semestres', 
            'code' => 21,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('school_workshops')->insert([
            'id' => 2,
            'name' => 'Música',
            'description' => 'Taller dictado los primeros semestres',
            'code' => 21,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('school_workshops')->insert([
            'id' => 3,
            'name' => 'Fisica',
            'description' => 'Taller dictado los primeros semestres',
            'code' => 21,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('school_workshops')->insert([
            'id' => 4,
            'name' => 'Canto',
            'description' => 'Taller dictado los segundos semestres',
            'code' => 21,
            'requirement_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('school_workshops')->insert([
            'id' => 5,
            'name' => 'Biologia',
            'description' => 'Taller dictado en vacaciones de verano',
            'code' => 21,
            'requirement_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('school_workshops')->insert([
            'id' => 6,
            'name' => 'Robotica 2',
            'description' => 'Taller dictado en vacaciones de invierno',
            'code' => 21,
            'requirement_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
