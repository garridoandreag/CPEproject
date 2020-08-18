<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE COUNTRY (
              id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              name varchar(100) NOT NULL,
              created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              status enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
              PRIMARY KEY (id)
            ) ENGINE=InnoDB;
            ");

        Schema::table('person', function (Blueprint $table) {
        $table->foreign('country_id')->references('id')->on('country');
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
        Schema::drop('country');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
