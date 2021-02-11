<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE JOB(
            id int(255) unsigned not null,
            job varchar(100) not null,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_job PRIMARY KEY (id)
            )ENGINE=InnoDb;
            ");

            Schema::table('employee', function (Blueprint $table) {
                $table->foreign('job_id')->references('id')->on('job');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('job');
//        Schema::drop('estudiante_encargado');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
