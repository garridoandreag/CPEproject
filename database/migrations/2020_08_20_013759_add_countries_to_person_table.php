<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountriesToPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('person', function (Blueprint $table) {
            //
            $table->string('country_code');
            $table->string('subdivision_code');
        });

       Schema::table('person', function (Blueprint $table) {
            $table->foreign('country_code')->references('code')->on('country');
            $table->foreign('subdivision_code')->references('code')->on('subdivision');
        });
       /* DB::statement("
        ALTER TABLE person ADD CONSTRAINT fk_person_country FOREIGN KEY (`country_code`) REFERENCES country(`code`);


        ");
*/



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('person', function (Blueprint $table) {
            //
        });
    }
}
