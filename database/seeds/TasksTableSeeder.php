<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            ['Comité de Contenidos', 'Participar del comité en representación de su sede y en caso de ausencia, enviar representante debidamente informado.'],
            ['Envío de Videos Impulso Docente', '2 horas por video, 2 videos por mentor'],
            ['Encargado Registro Fotográfico y redes sociales', 'Coordinar que se saquen fotografías clase a clase y sean subidas al grupo de Facebook del programa.'],
            ['Responsable Notas y asistencia', 'Subir Asistencia y Notas, sesión a sesión hasta el lunes siguiente de realizada la sesión.'],
            ['Encargado Plotters y Materiales', 'Coordinar los plotters de cada sesión, además de algún material necesario para la clase.'],
            ['Participación en reunión general', 'Instancia de organización general de cada sede, 2 horas por mentor.'],
            ['Seguimiento y fidelización alumnos', 'Seguimiento telefónico de los alumnos que no asisten a clases.'],
            ['Encargado Programación y mantención PC taller', 'Asegurar que los programas estén correctamente instalados y funcionando.'],
            ['Encargado Espacios y colaciones', 'Coordinar montaje y desmontaje sala, conseguir llave,  definir distribución de mesas y sillas. Coordinar que las colaciones estén en el momento oportuno.'],
            ['Revisión y mantenimiento de robots, baterías', 'Mantenimiento Robots, Botiquin completo, librerías actualizadas, reporte de falencias a Asesor Técnico.'],
            ['Encargado Capacitación Mediadores', 'Persona responsable de la correcta preparación de los mediadores, asegurar que estos manejen los conceptos y tengan claro el desafío.'],
        ];

        for ($i=0; $i < count($tasks); $i++) { 
	        DB::table('tasks')->insert([
	            'id' => $i+1,
	            'name' => $tasks[$i][0],
	            'description' => $tasks[$i][1],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
	        ]);
        }
    }
}
