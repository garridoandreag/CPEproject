<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('job')->insert(array(
            'id' => 1,
            'job' => 'Director(a)'
        ));

        
        DB::table('job')->insert(array(
            'id' => 2,
            'job' => 'Docente'
        ));

        DB::table('job')->insert(array(
            'id' => 3,
            'job' => 'Secretario(a)'
        ));

        DB::table('job')->insert(array(
            'id' => 4,
            'job' => 'Coordinador(a)'
        ));

    }
}
