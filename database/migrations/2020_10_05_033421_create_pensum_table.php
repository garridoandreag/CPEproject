<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePensumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            DB::statement("
            CREATE TABLE PENSUM(
            grade_id int(255) unsigned not null,
            course_id int(255) unsigned not null,
            pensumcoursegroup_id int(10) unsigned not null,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO'
            )ENGINE=InnoDb;");

            Schema::table('PENSUM', function (Blueprint $table) {
                $table->foreign('grade_id')->references('id')->on('grade');
                $table->foreign('course_id')->references('id')->on('course');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pensum');
    }
}
