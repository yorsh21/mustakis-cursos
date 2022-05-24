<?php

use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters')->insert([
            'id' => 8,
            'type' => 'document', 
            'key' => 'auth_doc', 
            'value' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parameters')->insert([
            'id' => 9,
            'type' => 'document', 
            'key' => 'school_doc', 
            'value' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parameters')->insert([
            'id' => 10,
            'type' => 'document', 
            'key' => 'cession_doc', 
            'value' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parameters')->insert([
            'id' => 11,
            'type' => 'document', 
            'key' => 'license_student', 
            'value' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parameters')->insert([
            'id' => 12,
            'type' => 'document', 
            'key' => 'license_tutor', 
            'value' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parameters')->insert([
            'id' => 13,
            'type' => 'document', 
            'key' => 'recomendation_doc', 
            'value' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //RUN: db:seed --class=DocumentsTableSeeder
    }
}
