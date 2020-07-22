<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudenttutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE STUDENTTUTOR(
            student_id int(255) UNSIGNED NOT NULL,
            tutor_id int(255) UNSIGNED NOT NULL,
            relationship varchar(100) not null,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_studenttutor PRIMARY KEY (student_id,tutor_id),
            CONSTRAINT fk_studenttutor_student FOREIGN KEY (student_id) REFERENCES student(id),
            CONSTRAINT fk_studenttutor_tutor FOREIGN KEY (tutor_id) REFERENCES tutor(id)
            )ENGINE=InnoDb;
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studenttutor');
    }
}
