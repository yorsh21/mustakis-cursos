<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionesTableSeeder::class);
        $this->call(ComunasTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CampusTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(PeriodsTableSeeder::class);
        $this->call(SchoolWorkshopTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(MaterialsTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(DivisionUsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(SchoolWorkshopCampusTable::class);

    }
}
