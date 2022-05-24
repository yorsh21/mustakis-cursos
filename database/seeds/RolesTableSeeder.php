<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('roles')->truncate();

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Administrador',
            'description' => 'Administrador del Sistema',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Coordinador',
            'description' => 'Coordinadores de Sedes',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Mentor',
            'description' => 'Profesores de Cursos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'Alumno',
            'description' => 'Alumnos de Cursos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'id' => 5,
            'name' => 'Voluntario',
            'description' => 'Asistentes de Cursos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'id' => 6,
            'name' => 'Asesor',
            'description' => 'Revisor de Profesores',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
