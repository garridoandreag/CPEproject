<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE SUBJECT(
            grade_id int(255) UNSIGNED NOT NULL,
            course_id int(255) UNSIGNED NOT NULL,
            cycle_id int(255) UNSIGNED NOT NULL,
            employee_id int(255) UNSIGNED NOT NULL,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_subject PRIMARY KEY (grade_id,course_id,cycle_id),
            CONSTRAINT fk_subject_grade FOREIGN KEY (grade_id) REFERENCES grade(id),
            CONSTRAINT fk_subject_course FOREIGN KEY (course_id) REFERENCES course(id),
            CONSTRAINT fk_subject_cycle FOREIGN KEY (cycle_id) REFERENCES cycle(id),
            CONSTRAINT fk_subject_employee FOREIGN KEY (employee_id) REFERENCES employee(id)
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
        Schema::dropIfExists('subject');
    }
}
