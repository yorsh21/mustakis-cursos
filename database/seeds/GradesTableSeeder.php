<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            'id' => 1,
            'capacity' => '20',
            'type' => 'Presencial',
            'start_date' => '2018-02-15',
            'end_date' => '2018-03-20',
            'school_workshop_id' => 1,
            'period_id' => 1,
            'campus_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('grades')->insert([
            'id' => 2,
            'capacity' => '18',
            'type' => 'Presencial',
            'start_date' => '2018-02-07',
            'end_date' => '2018-03-28',
            'school_workshop_id' => 2,
            'period_id' => 1,
            'campus_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('grades')->insert([
            'id' => 3,
            'capacity' => '25',
            'type' => 'Presencial',
            'start_date' => '2018-02-20',
            'end_date' => '2018-03-17',
            'school_workshop_id' => 3,
            'period_id' => 1,
            'campus_id' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
