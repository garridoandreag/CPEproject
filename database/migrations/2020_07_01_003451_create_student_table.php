<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE STUDENT(
            id int(255) unsigned not null,
            student_code varchar(100),
          `birthday` date DEFAULT NULL,
            grade_id int(255) unsigned,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_student PRIMARY KEY (id),
            CONSTRAINT fk_student_person FOREIGN KEY (id) REFERENCES person(id),
            CONSTRAINT fk_student_grade FOREIGN KEY (grade_id) REFERENCES grade(id)
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
        Schema::dropIfExists('student');
    }
}
