<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE HOMEWORK(
            id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
            activity_id int(255) UNSIGNED NOT NULL,
            subjectstudent_id int(255) UNSIGNED NOT NULL,
            student_id int(255) UNSIGNED NOT NULL,
            unit_id int(255) UNSIGNED NOT NULL,
            points decimal(10,0) not null default '0',
            delivery_date date,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_homework PRIMARY KEY (id),
            CONSTRAINT fk_homework_activity FOREIGN KEY (activity_id) REFERENCES activity(id),
            CONSTRAINT fk_homework_subjectstudent FOREIGN KEY (subjectstudent_id) REFERENCES subjectstudent(id),
            CONSTRAINT fk_homework_student FOREIGN KEY (student_id) REFERENCES student(id),
            CONSTRAINT fk_homework_unit FOREIGN KEY (unit_id) REFERENCES unit(id)
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
        Schema::dropIfExists('homework');
    }
}
