<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Ponderación por Curso
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_curso',
            'value' => 0.20,
        ]);

        //Ponderación por Transporte
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_transporte',
            'value' => 0.15,
        ]);

        //Ponderación por Establecimiento
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_establecimiento',
            'value' => 0.15,
        ]);

        //Ponderación por Postulación
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_postulacion',
            'value' => 0.25,
        ]);
        
        //Carta Motivacional
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_carta_motivacional',
            'value' => 0.25,
        ]);

        
        //Ponderación por Género
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_genero',
            'value' => 0,
        ]);

        //Ponderación Dependencia Establecimiento
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_dependencia',
            'value' => 0,
        ]);

        //Ponderación Tipo Establecimiento
        DB::table('parameters')->insert([
            'type' => 'weighing',
            'key' => 'ponderacion_tipo_establecimiento',
            'value' => 0,
        ]);


        /////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////


        //Puntaje por Curso
        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_7_basico',
            'value' => 1,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_8_basico',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_1_medio',
            'value' => 1,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_2_medio',
            'value' => 1,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_3_medio',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_4_medio',
            'value' => 0,
        ]);


        //Puntaje por Transporte
        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_si_transporte',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_no_transporte',
            'value' => 0,
        ]);


        //Puntaje por Postulación
        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_propia',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_propia_apoderados',
            'value' => 2,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_propia_profesores',
            'value' => 1,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_propia_apoderados_profesores',
            'value' => 2,
        ]);

        //Puntaje por Establecimiento
        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_no_establecimiento',
            'value' => 0,
        ]);


        //Puntaje por Género
        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_masculino',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_femenino',
            'value' => 0,
        ]);

        //Ponderación Dependencia Establecimiento
        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_establecimiento_municipal',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_establecimiento_particular_subvencionado',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_establecimiento_particular',
            'value' => 0,
        ]);


        //Ponderación Tipo Establecimiento
        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_tipo_cientifico',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_tipo_tecnico',
            'value' => 0,
        ]);

        DB::table('parameters')->insert([
            'type' => 'scores',
            'key' => 'puntaje_tipo_n_a',
            'value' => 0,
        ]);

    }
}
