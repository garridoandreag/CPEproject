<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePensumcoursegroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE TABLE `pensumcoursegroup` (
            id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
            name varchar(50),
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_pensumcoursegroup PRIMARY KEY (id)
          ) ENGINE=InnoDB;
        ");

        Schema::table('PENSUM', function (Blueprint $table) {
            $table->foreign('pensumcoursegroup_id')->references('id')->on('pensumcoursegroup');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pensumcoursegroups');
    }
}
