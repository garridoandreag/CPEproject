<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("
            CREATE TABLE IF NOT EXISTS `person` (
              `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `names` varchar(100) NOT NULL,
              `first_surname` varchar(100) NOT NULL,
              `second_surname` varchar(100) NOT NULL,
              `favorite_name` varchar(100) DEFAULT NULL,
              `phone_number` varchar(100) DEFAULT NULL,
              `cellphone_number` varchar(100) DEFAULT NULL,
              `department_id` int(10) UNSIGNED DEFAULT NULL,
              `zone_id` int(10) UNSIGNED DEFAULT NULL,
              `home_address` varchar(300) DEFAULT NULL,
              `occupation` varchar(100) DEFAULT NULL,
              `picture` varchar(300) DEFAULT NULL,
              `gender_id` char(20) NOT NULL,
              `employee` tinyint(1) DEFAULT '0',
              `tutor` tinyint(1) DEFAULT '0',
              `student` tinyint(1) DEFAULT '0',
              `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
              `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `status` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
              PRIMARY KEY (`id`),
              KEY `fk_person_gender` (`gender_id`)
            ) ENGINE=InnoDB;
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
    public function down() {
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('person');
//        Schema::drop('estudiante_encargado');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
