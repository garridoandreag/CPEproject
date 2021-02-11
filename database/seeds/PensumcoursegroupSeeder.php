<?php

use Illuminate\Database\Seeder;

class PensumcoursegroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pensumcoursegroup')->insert(array(
            'id' => 1,
            'name' => 'General'
                )
        );

        DB::table('pensumcoursegroup')->insert(array(
            'id' => 2,
            'name' => 'Autogobierno y Desarrollo Social'
                )
        );

        DB::table('pensumcoursegroup')->insert(array(
            'id' => 3,
            'name' => 'Destrezas de Aprendizaje'
                )
        );

        DB::table('pensumcoursegroup')->insert(array(
            'id' => 4,
            'name' => 'Comunicación y Lenguaje'
                )
        );

        DB::table('pensumcoursegroup')->insert(array(
            'id' => 5,
            'name' => 'Medio Social y Natural'
                )
        );

        DB::table('pensumcoursegroup')->insert(array(
            'id' => 6,
            'name' => 'Expresión Artística'
                )
        );


        DB::table('pensumcoursegroup')->insert(array(
            'id' => 7,
            'name' => 'Educación Física / Karate'
                )
        );


        DB::table('pensumcoursegroup')->insert(array(
            'id' => 8,
            'name' => 'Áreas Anexas'
                )
        );


    }
}
