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


        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

       
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('zone');
//        Schema::drop('estudiante_encargado');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
