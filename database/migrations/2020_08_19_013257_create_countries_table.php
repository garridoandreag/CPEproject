<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->boolean('status')->default(1);
            $table->string('name', 100);
            $table->text('description');
            $table->string('alpha2', 2)->unique();
            $table->string('alpha3', 3);
            $table->timestamps();
            $table->engine = "InnoDB";
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('country');
//        Schema::drop('estudiante_encargado');
      
    }
}
