<?php

use Illuminate\Database\Seeder;

class pensumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 4; $i <= 6 ; $i++){
            for($j = 1; $j <= 20 ; $j++){
            DB::table('pensum')->insert(array(
                'grade_id' => $i,
                'course_id' => $j
            ));
        }
        }

        for($i = 1; $i <= 3 ; $i++){
            for($j = 1; $j <= 21 ; $j++){
                if($j==3 || $j==4){

                }else{
                    DB::table('pensum')->insert(array(
                        'grade_id' => $i,
                        'course_id' => $j
                    ));
                }
        }
        }
        
        $this->command->info('La tabla PENSUM ha sido rellenada.');
    }
}
