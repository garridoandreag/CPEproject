<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
                CREATE TABLE SCHEDULE(
                id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
                grade_id int(255) UNSIGNED NOT NULL,
                course_id int(255) UNSIGNED NOT NULL,
                cycle_id int(255) UNSIGNED NOT NULL,
                day_id char(20) not null,
                start_time time,
                end_time time,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
                CONSTRAINT pk_schedule PRIMARY KEY (id),
                CONSTRAINT fk_schedule_day FOREIGN KEY (day_id) REFERENCES day(id),
                CONSTRAINT fk_schedule_subject1 FOREIGN KEY (grade_id) REFERENCES subject(grade_id),
                CONSTRAINT fk_schedule_subject2 FOREIGN KEY (course_id) REFERENCES subject(course_id),
                CONSTRAINT fk_schedule_subject3 FOREIGN KEY (cycle_id) REFERENCES subject(cycle_id)
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
        Schema::dropIfExists('schedule');
    }
}
