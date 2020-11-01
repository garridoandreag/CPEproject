<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 4 ; $i++){
            DB::table('unit')->insert(array(
                'name' => $i.'° Bloque',
            ));
        }
        
        $this->command->info('La tabla UNIT ha sido rellenada.');

    }
}
