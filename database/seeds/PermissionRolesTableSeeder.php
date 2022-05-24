<?php

use Illuminate\Database\Seeder;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contador = 1;
        $roles = [
            'admin' => 1,
            'coordinator' => 1,
            'teacher' => 1,
            'student' => 1,
            'voluntary' => 1,
        ];

        //permisos mainView roles
        DB::table('permission_roles')->insert([
            'id' => 1,
            'rol_id' => 1,
            'permission_id' => 1,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 2,
            'rol_id' => 2,
            'permission_id' => 1,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 3,
            'rol_id' => 3,
            'permission_id' => 1,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 4,
            'rol_id' => 4,
            'permission_id' => 1,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 5,
            'rol_id' => 5,
            'permission_id' => 1,
        ]);


        // Seeder permisos rol Administrador
        for($i = 6; $i <= 113; $i++){
            DB::table('permission_roles')->insert([
                'id' => $i,
                'rol_id' => 1,
                'permission_id' => $i,
            ]);
        }


        //Seeder permisos rol Alumno

        // UserController ->  show - edit - update
        // PostController -> index - create - store - show -  edit - update - destroy
        // GradeController -> index -> no - show
        // RequestController -> index - store - destroy
        // permisos usuario Alumno
       DB::table('permission_roles')->insert([
            'id' => 114,
            'rol_id' => 4,
            'permission_id' => 5,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 115,
            'rol_id' => 4,
            'permission_id' => 6,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 116,
            'rol_id' => 4,
            'permission_id' => 7,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 117,
            'rol_id' => 4,
            'permission_id' => 65,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 118,
            'rol_id' => 4,
            'permission_id' => 66,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 119,
            'rol_id' => 4,
            'permission_id' =>67,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 120,
            'rol_id' => 4,
            'permission_id' => 68,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 121,
            'rol_id' => 4,
            'permission_id' => 69,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 122,
            'rol_id' => 4,
            'permission_id' => 70,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 123,
            'rol_id' => 4,
            'permission_id' => 71,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 124,
            'rol_id' => 4,
            'permission_id' => 71,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 125,
            'rol_id' => 4,
            'permission_id' => 37,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 126,
            'rol_id' => 4,
            'permission_id' => 40,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 127,
            'rol_id' => 4,
            'permission_id' => 79,
        ]);

       /* DB::table('permission_roles')->insert([
            'id' => 128,
            'rol_id' => 4,
            'permission_id' => 80,
        ]); */

        DB::table('permission_roles')->insert([
            'id' => 129,
            'rol_id' => 4,
            'permission_id' => 81,
        ]);

       /* DB::table('permission_roles')->insert([
            'id' => 130,
            'rol_id' => 4,
            'permission_id' => 82,
        ]); */

        DB::table('permission_roles')->insert([
            'id' => 131,
            'rol_id' => 4,
            'permission_id' => 85,
        ]);


        //Seeder permisos rol Profesor

        // UserController -> show - edit - update
        // PostController -> index - create - store - show - edit - update - destroy
        // GradeController -> index - show
        // BlockGradeUserController ->index - show - edit -> update -> destroy // evaluaciones
        // permisos usuario profesor
        DB::table('permission_roles')->insert([
            'id' => 132,
            'rol_id' => 3,
            'permission_id' => 5,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 133,
            'rol_id' => 3,
            'permission_id' => 6,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 134,
            'rol_id' => 3,
            'permission_id' => 7,
        ]);
        //
        DB::table('permission_roles')->insert([
            'id' => 135,
            'rol_id' => 3,
            'permission_id' => 65,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 136,
            'rol_id' => 3,
            'permission_id' => 66,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 137,
            'rol_id' => 3,
            'permission_id' =>67,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 138,
            'rol_id' => 3,
            'permission_id' => 68,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 139,
            'rol_id' => 3,
            'permission_id' => 69,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 140,
            'rol_id' => 3,
            'permission_id' => 70,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 141,
            'rol_id' => 3,
            'permission_id' => 71,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 142,
            'rol_id' => 3,
            'permission_id' => 37,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 143,
            'rol_id' => 3,
            'permission_id' => 40,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 144,
            'rol_id' => 3,
            'permission_id' => 23,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 145,
            'rol_id' => 3,
            'permission_id' => 26,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 146,
            'rol_id' => 3,
            'permission_id' => 27,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 147,
            'rol_id' => 3,
            'permission_id' => 28,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 148,
            'rol_id' => 3,
            'permission_id' => 29,
        ]);

        //Seeder permisos rol Voluntario

        // UserController -> show - edit - update
        // PostController -> index - create - store - show - edit - update - destroy
        // GradeController -> show
        // BlockGradeUserController ->index - show - edit -> update -> - destroy // evaluaciones
        // MaterialController -> index - create - store - destroy
        // permisos usuario Voluntario
        DB::table('permission_roles')->insert([
            'id' => 149,
            'rol_id' => 5,
            'permission_id' => 5,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 150,
            'rol_id' => 5,
            'permission_id' => 6,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 151,
            'rol_id' => 5,
            'permission_id' => 7,
        ]);

        //
        DB::table('permission_roles')->insert([
            'id' => 152,
            'rol_id' => 5,
            'permission_id' => 65,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 153,
            'rol_id' => 5,
            'permission_id' => 66,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 154,
            'rol_id' => 5,
            'permission_id' =>67,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 155,
            'rol_id' => 5,
            'permission_id' => 68,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 156,
            'rol_id' => 5,
            'permission_id' => 69,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 157,
            'rol_id' => 5,
            'permission_id' => 70,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 158,
            'rol_id' => 5,
            'permission_id' => 71,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 159,
            'rol_id' => 5,
            'permission_id' => 19,
        ]);

        //

        DB::table('permission_roles')->insert([
            'id' => 160,
            'rol_id' => 5,
            'permission_id' => 23,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 161,
            'rol_id' => 5,
            'permission_id' => 26,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 162,
            'rol_id' => 5,
            'permission_id' => 27,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 163,
            'rol_id' => 5,
            'permission_id' => 28,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 164,
            'rol_id' => 5,
            'permission_id' => 29,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 165,
            'rol_id' => 5,
            'permission_id' => 44,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 166,
            'rol_id' => 5,
            'permission_id' => 29,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 167,
            'rol_id' => 5,
            'permission_id' => 44,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 168,
            'rol_id' => 5,
            'permission_id' => 45,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 169,
            'rol_id' => 5,
            'permission_id' => 46,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 170,
            'rol_id' => 5,
            'permission_id' => 50,
        ]);
        //Seeder permisos rol Coordinador

        // PostulationController-> index - show
        // BlockGradeController -> index - create - store - edit - update - destroy
        //DivisionUserController -> index - edit - update - destroy

        DB::table('permission_roles')->insert([
            'id' => 171,
            'rol_id' => 2,
            'permission_id' => 72,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 172,
            'rol_id' => 2,
            'permission_id' => 75,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 173,
            'rol_id' => 2,
            'permission_id' => 16,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 174,
            'rol_id' => 2,
            'permission_id' => 17,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 175,
            'rol_id' => 2,
            'permission_id' => 18,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 176,
            'rol_id' => 2,
            'permission_id' => 19,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 177,
            'rol_id' => 2,
            'permission_id' => 20,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 178,
            'rol_id' => 2,
            'permission_id' => 21,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 179,
            'rol_id' => 2,
            'permission_id' => 22,
        ]);


        //Permisos de Métodos Extras
        DB::table('permission_roles')->insert([
            'id' => 180,
            'rol_id' => 1,
            'permission_id' => 114,
        ]);
        DB::table('permission_roles')->insert([
            'id' => 181,
            'rol_id' => 1,
            'permission_id' => 115,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 182,
            'rol_id' => 1,
            'permission_id' => 116,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 183,
            'rol_id' => 1,
            'permission_id' => 117,
        ]);

        DB::table('permission_roles')->insert([
            'id' => 184,
            'rol_id' => 1,
            'permission_id' => 118,
        ]);

    }
}
