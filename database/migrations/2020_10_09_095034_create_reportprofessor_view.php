<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportprofessorView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("


        CREATE VIEW REPORTPROFESSOR AS(
            SELECT 
            `c`.`id` AS `id`,
            `c`.`name` AS `name`,
            SUM((CASE
                WHEN (`u`.`id` = 1) THEN `hw`.`points`
                ELSE 0
            END)) AS `bloque1`,
            SUM((CASE
                WHEN (`u`.`id` = 2) THEN `hw`.`points`
                ELSE 0
            END)) AS `bloque2`,
            SUM((CASE
                WHEN (`u`.`id` = 3) THEN `hw`.`points`
                ELSE 0
            END)) AS `bloque3`,
            SUM((CASE
                WHEN (`u`.`id` = 4) THEN `hw`.`points`
                ELSE 0
            END)) AS `bloque4`,
            SUM(`ss`.`score_subject`) AS `total`,
            `ss`.`student_id` AS `student_id`,
            `ss`.`cycle_id` AS `cycle_id`,
            `ss`.`coursegrade_id` AS `coursegrade_id`,
            `cg`.`employee_id` AS `employee_id`
        FROM
            ((((`cpe_bd`.`subjectstudent` `ss`
            JOIN `cpe_bd`.`coursegrade` `cg` ON ((`ss`.`coursegrade_id` = `cg`.`id`)))
            JOIN `cpe_bd`.`course` `c` ON ((`cg`.`course_id` = `c`.`id`)))
            LEFT JOIN `cpe_bd`.`homework` `hw` ON ((`ss`.`id` = `hw`.`subjectstudent_id`)))
            LEFT JOIN `cpe_bd`.`unit` `u` ON ((`hw`.`unit_id` = `u`.`id`)))
        WHERE
            (`c`.`id` = 12)
        GROUP BY `c`.`id` , `c`.`name` , `ss`.`student_id` , `ss`.`cycle_id` , `ss`.`coursegrade_id` , `cg`.`employee_id`)
            
        
        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportprofessor_view');
    }
}
