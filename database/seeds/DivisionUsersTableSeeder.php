<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DivisionUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Alumnos robotica
        DB::table('division_users')->insert([
            'id' => 1,
            'aptitude_score' => 0,
            'grade_id' => 1,
            'user_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('division_users')->insert([
            'id' => 2,
            'aptitude_score' => 0,
            'grade_id' => 1,
            'user_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('division_users')->insert([
            'id' => 3,
            'aptitude_score' => 0,
            'grade_id' => 1,
            'user_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);



        // Alumnos Musica
        DB::table('division_users')->insert([
            'id' => 4,
            'aptitude_score' => 0,
            'grade_id' => 2,
            'user_id' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('division_users')->insert([
            'id' => 5,
            'aptitude_score' => 0,
            'grade_id' => 2,
            'user_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('division_users')->insert([
            'id' => 6,
            'aptitude_score' => 0,
            'grade_id' => 2,
            'user_id' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        //Profesores

        DB::table('division_users')->insert([
            'id' => 7,
            'aptitude_score' => 0,
            'grade_id' => 1,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('division_users')->insert([
            'id' => 8,
            'aptitude_score' => 0,
            'grade_id' => 2,
            'user_id' => 11,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}
