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
            SELECT distinct S.ID id, S.STUDENT_CODE student_code, P.NAMES names, P.FIRST_SURNAME first_surname, P.SECOND_SURNAME second_surname, C.ID cycle_id, C.NAME CYCLE, G.ID grade_id,G.NAME GRADE, P.PICTURE
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
