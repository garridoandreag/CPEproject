<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectstudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE SUBJECTSTUDENT(
            id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
            student_id int(255) UNSIGNED NOT NULL,
            grade_id int(255) UNSIGNED NOT NULL,
            course_id int(255) UNSIGNED NOT NULL,
            cycle_id int(255) UNSIGNED NOT NULL,
            score_subject int(255) unsigned not null default '0',
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_subjectstudent PRIMARY KEY (id),
            CONSTRAINT fk_subjectstudent_subject1 FOREIGN KEY (grade_id) REFERENCES subject(grade_id),
            CONSTRAINT fk_subjectstudent_subject2 FOREIGN KEY (course_id) REFERENCES subject(course_id),
            CONSTRAINT fk_subjectstudent_subject3 FOREIGN KEY (cycle_id) REFERENCES subject(cycle_id),
            CONSTRAINT fk_subjectstudent_student  FOREIGN KEY (student_id) REFERENCES student(id)
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
        Schema::dropIfExists('subjectstudent');
    }
}
