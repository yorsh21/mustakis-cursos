<?php

use Illuminate\Database\Seeder;

class TerceraFaseSee extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 6,
            'name' => 'Asesor',
            'description' => 'Revisor de Profesores',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
