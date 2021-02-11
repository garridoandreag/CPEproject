<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListstudentView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW LISTSTUDENT AS(
            SELECT DISTINCT
            `s`.`id` AS `ID`,
            `s`.`student_code` AS `STUDENT_CODE`,
            `p`.`names` AS `NAMES`,
            `p`.`first_surname` AS `FIRST_SURNAME`,
            `p`.`second_surname` AS `SECOND_SURNAME`,
            `c`.`id` AS `CYCLE_ID`,
            `c`.`name` AS `CYCLE`,
            `g`.`id` AS `GRADE_ID`,
            `g`.`name` AS `GRADE`,
            `p`.`picture` AS `PICTURE`
        FROM
            ((((`cpe_bd`.`subjectstudent` `ss`
            JOIN `cpe_bd`.`person` `p` ON ((`p`.`id` = `ss`.`student_id`)))
            JOIN `cpe_bd`.`student` `s` ON ((`s`.`id` = `ss`.`student_id`)))
            JOIN `cpe_bd`.`cycle` `c` ON ((`c`.`id` = `ss`.`cycle_id`)))
            JOIN `cpe_bd`.`grade` `g` ON ((`g`.`id` = `ss`.`grade_id`)))
            );
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liststudent_view');
    }
}
