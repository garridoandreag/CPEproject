<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE SCHOOL(
              id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
              name varchar(100) not null,
              phone_number VARCHAR(100),
              cellphone_number varchar(100),
              address varchar(300),
              vision mediumtext,
              mision mediumtext,
              history mediumtext,
              logo varchar(300),
              facebook_url varchar(300),
              email varchar(300),
              created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
              status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
              CONSTRAINT pk_school PRIMARY KEY (id)
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
        Schema::dropIfExists('school');
    }
}
