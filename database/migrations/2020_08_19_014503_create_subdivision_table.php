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
          $table->boolean('status')->default(1);
          $table->string('country_code');
          $table->string('name', 100);
          $table->text('description');
          $table->foreign('country_code')->references('code')->on('country');
          $table->timestamps();
          $table->engine = "InnoDB";
          $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subdivision');
    }
}
