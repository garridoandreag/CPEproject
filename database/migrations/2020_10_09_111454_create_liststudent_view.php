<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListstudentView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW LISTSTUDENT AS(
            SELECT distinct S.ID, S.STUDENT_CODE, P.NAMES, P.FIRST_SURNAME, P.SECOND_SURNAME,C.ID COURSE_ID, C.NAME COURSE, G.ID GRADE_ID,G.NAME GRADE
            FROM SUBJECTSTUDENT SS
            INNER JOIN PERSON P ON P.ID=SS.STUDENT_ID
            INNER JOIN STUDENT S ON S.ID=SS.STUDENT_ID
            INNER JOIN CYCLE C ON C.ID=SS.CYCLE_ID
            INNER JOIN GRADE G ON G.ID=SS.GRADE_ID
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
        Schema::dropIfExists('liststudent_view');
    }
}
