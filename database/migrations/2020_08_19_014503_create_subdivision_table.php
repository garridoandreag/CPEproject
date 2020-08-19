<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdivisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdivision', function (Blueprint $table) {
          $table->string('code')->primary();
          $table->string('country_code');
          $table->string('name', 100);
          $table->text('description');
          $table->foreign('country_code')->references('code')->on('countries');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Subdivision');
    }
}
