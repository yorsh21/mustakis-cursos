<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $FORUM_ANUNCIO = 'anuncio';
        $FORUM_CONSULTA = 'consulta';

        //posts Anuncios
        DB::table('posts')->insert([
            'id' => 1,
            'title' => 'Bienvenidos al curso',
            'body' => 'Les doy la bienvenido a todos a este curso',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 7,
            'parent_id' => null,
            'grade_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('posts')->insert([
            'id' => 2,
            'title' => 'Informacion importante',
            'body' => 'Pronto subire informacion respecto al curso, atentos',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 7,
            'parent_id' => null,
            'grade_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);



        DB::table('posts')->insert([
            'id' => 3,
            'title' => 'Evaluación',
            'body' => 'Esta semana es la primera evaluación del curso, estudien.',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 8,
            'parent_id' => null,
            'grade_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //posts Comentarios alumnos curso robotica

        DB::table('posts')->insert([
            'id' => 4,
            'title' => 'Gracias',
            'body' => 'Muchas gracias',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 1,
            'parent_id' => 1,
            'grade_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('posts')->insert([
            'id' => 5,
            'title' => 'Nos vemos en el aula',
            'body' => 'Gracias profesor',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 2,
            'parent_id' => 1,
            'grade_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('posts')->insert([
            'id' => 6,
            'title' => 'Saludos',
            'body' => 'Gracias por el recibimiento',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 3,
            'parent_id' => 1,
            'grade_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //posts comentarios curso musica

        DB::table('posts')->insert([
            'id' => 7,
            'title' => 'Consulta',
            'body' => '¿Que abarcara esta evaluación ?',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 4,
            'parent_id' => 3,
            'grade_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('posts')->insert([
            'id' => 8,
            'title' => 'Prueba de repetición',
            'body' => '¿Se repetira esta evaluación en otra fecha?',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 5,
            'parent_id' => 3,
            'grade_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('posts')->insert([
            'id' => 9,
            'title' => 'Apuntes',
            'body' => 'Espero que se puedan usar apuntes',
            'forum' => $FORUM_ANUNCIO,
            'division_user_id' => 6,
            'parent_id' => 3,
            'grade_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);



    }
}
