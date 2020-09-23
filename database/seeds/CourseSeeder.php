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

        $this->command->info('La tabla COURSE ha sido rellenada.');
    }

}
