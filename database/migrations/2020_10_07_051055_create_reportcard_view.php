<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportcardView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("

        create VIEW REPORTCARD AS(
            SELECT 
            C.name, 
            SUM(CASE WHEN U.id=1 THEN HW.points ELSE 0 END) 'bloque1',
            SUM(CASE WHEN U.id=2 THEN HW.points ELSE 0 END) 'bloque2',
            SUM(CASE WHEN U.id=3 THEN HW.points ELSE 0 END) 'bloque3',
            SUM(CASE WHEN U.id=4 THEN HW.points ELSE 0 END) 'bloque4',
            sum(SS.score_subject) 'total',
            SS.student_id,
            SS.cycle_id
            FROM SUBJECTSTUDENT SS
            INNER JOIN COURSEGRADE CG ON SS.coursegrade_id = CG.id
            INNER JOIN COURSE C ON CG.course_id = C.id
            LEFT JOIN HOMEWORK HW ON SS.id = HW.subjectstudent_id
            LEFT JOIN UNIT U ON HW.unit_id = U.id
            GROUP BY C.name,student_id,cycle_id
            );
        
        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportcard_view');
    }
}
