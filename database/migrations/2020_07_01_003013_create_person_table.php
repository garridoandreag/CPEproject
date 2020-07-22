<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE PERSON(
            id int unsigned not null,
            first_name varchar(100) not null,
            second_name varchar(100) not null,
            other_name varchar(100),
            first_surname varchar(100) not null,
            second_surname varchar(100) not null,
            other_surname varchar(100),
            maritalstatus_id int UNSIGNED NOT NULL,
            phone_number VARCHAR(100), 
            cellphone_number varchar(100),
            department varchar(100),
            home_address varchar(300),
            occupation varchar(100),
            birthday date,
            picture varchar(300),
            gender_id char(20) not null,
            employee BOOLEAN DEFAULT FALSE,
            tutor BOOLEAN DEFAULT FALSE,
            student BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_person PRIMARY KEY (id),
            CONSTRAINT fk_person_maritalstatus FOREIGN KEY (maritalstatus_id) REFERENCES maritalstatus(id),
            CONSTRAINT fk_person_gender FOREIGN KEY (gender_id) REFERENCES GENDER(id)
            )ENGINE=InnoDb;
            ");
        
        
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('person');
            $table->foreign('role_id')->references('id')->on('role');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
}
