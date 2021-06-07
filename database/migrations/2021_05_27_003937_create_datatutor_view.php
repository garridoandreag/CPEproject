<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatatutorView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW datatutor AS (
            SELECT p.names, p.first_surname, p.second_surname, p.cellphone_number, t.student_id 
            FROM studenttutor t
            INNER JOIN person p ON t.tutor_id=p.id
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datatutor');
    }
}
