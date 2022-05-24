<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            'UserController',
            'BlockController',
            'BlockGradeController',
            'BlockGradeUserController',
            'CampusController',
            'GradeController',
            'MaterialController',
            'ParameterController',
            'PeriodController',
            'PostController',
            'PostulationController',
            'RequestController',
            'RoomController',
            'SchoolWorkshopController',
            'PostController',
            'DivisionControllerController',
        ];

        $actions = [
            'index',
            'create',
            'store',
            'show',
            'edit',
            'update',
            'destroy',
            ''
        ];

        DB::table('permissions')->insert([
            'id' => 1,
            'model' => 'UserController',
            'action' => 'index',
        ]);

        $count = 2;
        for ($i=0; $i < 16; $i++) { 
            for ($j=0; $j < 7; $j++) { 
                DB::table('permissions')->insert([
                    'id' => $count,
                    'model' => $models[$i],
                    'action' => $actions[$j],
                ]);
                $count++;
            }
        }

        DB::table('permissions')->insert([
            'id' => $count++,
            'model' => 'BlockController',
            'action' => 'create_from_school',
        ]);

        DB::table('permissions')->insert([
            'id' => $count++,
            'model' => 'MaterialController',
            'action' => 'create_from_block',
        ]);

        DB::table('permissions')->insert([
            'id' => $count++,
            'model' => 'RoomController',
            'action' => 'create_from_campus',
        ]);

        DB::table('permissions')->insert([
            'id' => $count++,
            'model' => 'RequestController',
            'action' => 'cancel_request_student',
        ]);

        DB::table('permissions')->insert([
            'id' => $count++,
            'model' => 'MaterialController',
            'action' => 'download_file',
        ]);
    }
}
