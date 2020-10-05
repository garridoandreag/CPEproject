<?php

use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 6 ; $i++){
            DB::table('grade')->insert(array(
                'name' => $i.'° Primaria',
                'section' => 'A'
            ));
        }
        
        $this->command->info('La tabla GRADE ha sido rellenada.');
    }
}
