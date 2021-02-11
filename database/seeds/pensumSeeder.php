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
        for($i = 1; $i <= 9 ; $i++){
            for($j = 1; $j <=47  ; $j++){
            DB::table('pensum')->insert(array(
                'grade_id' => $i,
                'course_id' => $j,
                'pensumcoursegroup_id' => 1
            ));
        }
        }

        
        $this->command->info('La tabla PENSUM ha sido rellenada.');
    }
}
