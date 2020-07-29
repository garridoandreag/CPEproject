<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {


                DB::statement("
                    CREATE TABLE ZONE (
                      id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                      department_id int(10) UNSIGNED DEFAULT NULL,
                      name varchar(100) NOT NULL,
                      created_at  timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                      updated_at  timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                      status enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
                      PRIMARY KEY (id),
                      KEY fk_zone_department (department_id)
                    ) ENGINE=InnoDB;
            ");
        Schema::table('person', function (Blueprint $table) {
        $table->foreign('zone_id')->references('id')->on('zone');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('zone');
//        Schema::drop('estudiante_encargado');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
