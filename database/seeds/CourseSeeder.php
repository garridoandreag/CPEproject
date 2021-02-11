<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        DB::table('course')->insert(array(
            'name' => 'Comunicación y Lenguaje'
            )
        );

        DB::table('course')->insert(array(
          'name' => 'Matemática'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Ciencias Naturales'
          )
       );

        DB::table('course')->insert(array(
          'name' => 'Ciencias Sociales'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Medio Social y Natural'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Expresión Artística'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Formación Ciudadana'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Idioma Maya'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Computación'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Música'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Inglés'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Productividad y Desarrollo'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Conducta en clase'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Sociabilización'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Respeto a los demás'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Orden y Limpieza'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Responsabilidad en tareas'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Participación '
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Apariencia personal'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Puntualidad'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Entrega de tareas a tiempo'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Percepción'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Motrocidad'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Razonamiento Lógico'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Concepto de Número'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Toma de Dictados'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Iniciación a la lectoescritura'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Desarrollo de Sintaxis'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Iniciación de comprensión Lectora'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Trazo de Letra Script'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Trazo de Letra Cursiva'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Correspondencia Trazo-Sonido'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Desarrollo del Vocabulario'
          )
        );

        
        DB::table('course')->insert(array(
          'name' => 'Toma de Dictado'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Identificación con su entorno Natural'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Desarrollo de la Autonomía Personal'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Civismo'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Desarrollo de Valores'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Sensopercepción'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Comunicación'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Apreciación'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Utilización correcta de diferentes Técnicas'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Dominio corporal'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Discriminación Precepto-Motriz'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Habilidad Coordinativa'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Inglés L-3'
          )
        );

        DB::table('course')->insert(array(
          'name' => 'Asistencia'
          )
        );




        $this->command->info('La tabla COURSE ha sido rellenada.');
    }

}
