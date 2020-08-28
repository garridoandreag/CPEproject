<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration {

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
        public function down()
        {
            Schema::dropIfExists('department');
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('department');
//        Schema::drop('estudiante_encargado');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }
    }
    