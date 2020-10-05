<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        DB::table('gender')->insert(array(
            'id' => 1,
            'name' => 'Femenino'
                )
        );

        DB::table('gender')->insert(array(
            'id' => 2,
            'name' => 'Masculino'
                )
        );

        $this->command->info('La tabla GENDER ha sido rellenada.');
    }

}
