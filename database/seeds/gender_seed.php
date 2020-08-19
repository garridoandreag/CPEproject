<?php

use Illuminate\Database\Seeder;

class gender_seed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //


        DB::table('gender')->insert(array(
            'id' => 'M',
            'name' => 'MASCULINO'
                )
        );


        DB::table('gender')->insert(array(
            'id' => 'F',
            'name' => 'FEMENINO'
                )
        );

        $this->command->info('La tabla GENDER ha sido rellenada.');
    }

}
