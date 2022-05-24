<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $GENDER_MALE = 0;
        $GENDER_FEMALE = 1;

        DB::table('users')->insert([
            'id' => 1,
            'firstname' => 'Ezra',
            'lastname' => 'Powell',
            'email' => 'admin@mustakis.cl',
            //'email_tutor' => 'sed.est@nequepellentesquemassa.edu',
            //'email_teacher' => 'ac@ametluctusvulputate.org',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(1980,06,17),
            'rut' => '16202933-6',
            'genere' => $GENDER_MALE,
            'phone_number' => '984324567',
            'phone_number2' => '923475693',
            'address' => '#220-892 Nec Rd.',
            //'auth_doc' => 'file_auth',
            'commune_id' => 134,
            'rol_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'firstname' => 'Kirby',
            'lastname' => 'Valdez',
            'email' => 'coordinador@mustakis.cl',
            //'email_tutor' => 'Cras.interdum@eu.com',
            //'email_teacher' => 'Mauris.blandit@velarcu.ca',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(1980,06,17),
            'rut' => '21576767-3',
            'genere' => $GENDER_MALE,
            'phone_number' => '978674567',
            'phone_number2' => '911576853',
            'address' => '#220-892 Nec Rd.',
            //'auth_doc' => 'file_auth',
            'commune_id' => 312,
            'rol_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('users')->insert([
            'id' => 3,
            'firstname' => 'Zeph',
            'lastname' => 'Vazquez',
            'email' => 'profesor@mustakis.cl',
            //'email_tutor' => 'semper.egestas.urna@nonbibendumsed.ca',
            //'email_teacher' => 'ac@Donec.co.uk',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(1975,8,17),
            'rut' => '40624642-8',
            'genere' => $GENDER_MALE,
            'phone_number' => '98675462',
            'phone_number2' => '921435986',
            'address' => 'Peñaflor',
            //'auth_doc' => 'file_auth',
            'commune_id' => 296,
            'rol_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'firstname' => 'Haviva',
            'lastname' => 'Grames',
            'email' => 'alumno@mustakis.cl',
            'email_tutor' => 'massa.Vestibulum.accumsan@orciluctus.ca',
            'email_teacher' => 'viverra.Donec@aliquet.net',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(2003,8,15),
            'rut' => '20908358-8',
            'genere' => $GENDER_FEMALE,
            'phone_number' => '916354867',
            'phone_number2' => '776856780',
            'address' => 'Padre Hurtado',
            //'auth_doc' => 'file_auth',
            'commune_id' => 123,
            'rol_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'firstname' => 'Xanthus',
            'lastname' => 'Morrow',
            'email' => 'voluntario@mustakis.cl',
            //'email_tutor' => 'varius@atliberoMorbi.ca',
            //'email_teacher' => 'Nullam.ut@Phasellus.net',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(1993,8,8),
            'rut' => '37012713-4',
            'genere' => $GENDER_FEMALE,
            'phone_number' => '978884767',
            'phone_number2' => '944536216',
            'address' => 'Providencia',
            //'auth_doc' => 'file_auth',
            'commune_id' => 67,
            'rol_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('users')->insert([
            'id' => 6,
            'firstname' => 'Juan',
            'lastname' => 'Rojas',
            'email' => 'juan.r15@hotmail.com',
            'email_tutor' => 'car656@hotmail.com',
            'email_teacher' => 'octaviojara@gmail.com',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(2003,8,15),
            'rut' => '20345673-8',
            'genere' => $GENDER_MALE,
            'phone_number' => '98875642',
            'phone_number2' => '99897673',
            'address' => 'Colon 221',
            //'auth_doc' => 'file_auth',
            'commune_id' => 25,
            'rol_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('users')->insert([
            'id' => 7,
            'firstname' => 'Pedro',
            'lastname' => 'Reyes',
            'email' => 'pedro.reyes16@hotmail.com',
            'email_tutor' => 'carlakgi@hotmail.com',
            'email_teacher' => 'fer33@gmail.com',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(2003,6,20),
            'rut' => '20989344-8',
            'genere' => $GENDER_MALE,
            'phone_number' => '967584637',
            'phone_number2' => '988211545',
            'address' => 'Villa Tino',
            //'auth_doc' => 'file_auth',
            'commune_id' => 5,
            'rol_id' => 4
        ]);



        DB::table('users')->insert([
            'id' => 8,
            'firstname' => 'Camilo',
            'lastname' => 'acuña',
            'email' => 'camiloacuña@hotmail.com',
            'email_tutor' => 'javieraa_2@hotmail.com',
            'email_teacher' => 'estebangi233@gmail.com',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(2003,4,4),
            'rut' => '20345678-8',
            'genere' => $GENDER_MALE,
            'phone_number' => '986735375',
            'phone_number2' => '98768576',
            'address' => 'Viña',
            //'auth_doc' => 'file_auth',
            'commune_id' => 7,
            'rol_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);



        DB::table('users')->insert([
            'id' => 9,
            'firstname' => 'Javiera',
            'lastname' => 'Ordenes',
            'email' => 'jav_or@hotmail.com',
            'email_tutor' => 'jesz631@hotmail.com',
            'email_teacher' => 'kiaz411@gmail.com',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(2001,8,18),
            'rut' => '20564738-8',
            'genere' => $GENDER_FEMALE,
            'phone_number' => '987645361',
            'phone_number2' => '988876451',
            'address' => 'Alto las torres',
            //'auth_doc' => 'file_auth',
            'commune_id' => 50,
            'rol_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);



        DB::table('users')->insert([
            'id' => 10,
            'firstname' => 'Jessica',
            'lastname' => 'Fuentes',
            'email' => 'jetnef@hotmail.com',
            'email_tutor' => 'kim55@hotmail.com',
            'email_teacher' => 'teac23w@gmail.com',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(2004,5,3),
            'rut' => '20563748-8',
            'genere' => $GENDER_FEMALE,
            'phone_number' => '948576812',
            'phone_number2' => '983365743',
            'address' => 'Rosales',
            //'auth_doc' => 'file_auth',
            'commune_id' => 40,
            'rol_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);



        DB::table('users')->insert([
            'id' => 11,
            'firstname' => 'Carlos',
            'lastname' => 'Rojo',
            'email' => 'c.rojo_profesor@mustakis.cl',
            //'email_tutor' => 'semper.egestas.urna@nonbibendumsed.ca',
            //'email_teacher' => 'ac@Donec.co.uk',
            'password' => bcrypt('secret'),
            'birth_date' => Carbon::createFromDate(1980,5,12),
            'rut' => '40624642-8',
            'genere' => $GENDER_MALE,
            'phone_number' => '987452635',
            'phone_number2' => '978475612',
            'address' => 'providencia',
            //'auth_doc' => 'file_auth',
            'commune_id' => 120,
            'rol_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
