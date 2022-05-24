<?php

use Illuminate\Database\Seeder;

class RegionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regiones = ['Arica y Parinacota', 'Tarapacá', 'Antofagasta', 'Atacama', 'Coquimbo', 'Valparaíso', 'O\'Higgins', 'Maule', 'Biobío ', 'Araucanía', 'Los Ríos', 'Los Lagos', 'Aysén', 'Magallanes', 'Metropolitana'];

        for ($i=0; $i < 15; $i++) { 
	        DB::table('regions')->insert([
	            'id' => $i+1,
	            'name' => $regiones[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
	        ]);
        }
    }
}
