<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class PostulationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
$date = Carbon::now();
$date = $date->format('Y-m-d');

        DB::table('permissions')->insert([
            'id' => 1,
            'start_date' => $date,
            'end_date' => $date,
            'period_id' => 1,
            'school_workshop_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
