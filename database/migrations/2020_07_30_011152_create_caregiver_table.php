<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaregiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                DB::statement("
                    CREATE TABLE CAREGIVER (
                      id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                      student_id int(10) UNSIGNED DEFAULT NULL,
                      name varchar(100) NOT NULL,
                      surname varchar(100) NOT NULL,
                      relationship varchar(100) not null,
                      `phone_number` varchar(100) DEFAULT NULL,
                      created_at  timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                      updated_at  timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                      status enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
                      CONSTRAINT pk_caregiver PRIMARY KEY (id),
                      CONSTRAINT fk_student_caregiver FOREIGN KEY (student_id) REFERENCES student(id)
                    ) ENGINE=InnoDB;
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caregiver');
    }
}
