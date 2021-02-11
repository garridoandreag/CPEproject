<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReportcardView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::statement("

        create VIEW REPORTCARD AS(
            SELECT 
            `cpe_bd`.`c`.`id` AS `id`,
            `cpe_bd`.`ss`.`id` AS `subjectstudent_id`,
            `cpe_bd`.`c`.`name` AS `name`,
            `cpe_bd`.`p`.`courseorder` AS `courseorder`,
            `cpe_bd`.`p`.`pensumcoursegroup_id` AS `pensumcoursegroup_id`,
            `cpe_bd`.`pcg`.`name` AS `pensumcoursegroup`,
            SUM((CASE
                WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                ELSE 0
            END)) AS `bloque1`,
            SUM((CASE
                WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                ELSE 0
            END)) AS `bloque2`,
            SUM((CASE
                WHEN (`cpe_bd`.`u`.`id` = 3) THEN `cpe_bd`.`hw`.`points`
                ELSE 0
            END)) AS `bloque3`,
            SUM((CASE
                WHEN (`cpe_bd`.`u`.`id` = 4) THEN `cpe_bd`.`hw`.`points`
                ELSE 0
            END)) AS `bloque4`,
            IF(((SUM((CASE
                    WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END)) > 0)
                    AND (SUM((CASE
                    WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END)) > 0)
                    AND (SUM((CASE
                    WHEN (`cpe_bd`.`u`.`id` = 3) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END)) > 0)
                    AND (SUM((CASE
                    WHEN (`cpe_bd`.`u`.`id` = 4) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END)) > 0)),
                (SUM(((((CASE
                    WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END) + (CASE
                    WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END)) + (CASE
                    WHEN (`cpe_bd`.`u`.`id` = 3) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END)) + (CASE
                    WHEN (`cpe_bd`.`u`.`id` = 4) THEN `cpe_bd`.`hw`.`points`
                    ELSE 0
                END))) / 4),
                IF(((SUM((CASE
                        WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                        ELSE 0
                    END)) > 0)
                        AND (SUM((CASE
                        WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                        ELSE 0
                    END)) > 0)
                        AND (SUM((CASE
                        WHEN (`cpe_bd`.`u`.`id` = 3) THEN `cpe_bd`.`hw`.`points`
                        ELSE 0
                    END)) > 0)
                        AND (SUM((CASE
                        WHEN (`cpe_bd`.`u`.`id` = 4) THEN `cpe_bd`.`hw`.`points`
                        ELSE 0
                    END)) <= 0)),
                    (SUM((((CASE
                        WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                        ELSE 0
                    END) + (CASE
                        WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                        ELSE 0
                    END)) + (CASE
                        WHEN (`cpe_bd`.`u`.`id` = 3) THEN `cpe_bd`.`hw`.`points`
                        ELSE 0
                    END))) / 3),
                    IF(((SUM((CASE
                            WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                            ELSE 0
                        END)) > 0)
                            AND (SUM((CASE
                            WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                            ELSE 0
                        END)) > 0)
                            AND (SUM((CASE
                            WHEN (`cpe_bd`.`u`.`id` = 3) THEN `cpe_bd`.`hw`.`points`
                            ELSE 0
                        END)) <= 0)
                            AND (SUM((CASE
                            WHEN (`cpe_bd`.`u`.`id` = 4) THEN `cpe_bd`.`hw`.`points`
                            ELSE 0
                        END)) <= 0)),
                        (SUM(((CASE
                            WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                            ELSE 0
                        END) + (CASE
                            WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                            ELSE 0
                        END))) / 2),
                        IF(((SUM((CASE
                                WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                                ELSE 0
                            END)) > 0)
                                AND (SUM((CASE
                                WHEN (`cpe_bd`.`u`.`id` = 2) THEN `cpe_bd`.`hw`.`points`
                                ELSE 0
                            END)) <= 0)
                                AND (SUM((CASE
                                WHEN (`cpe_bd`.`u`.`id` = 3) THEN `cpe_bd`.`hw`.`points`
                                ELSE 0
                            END)) <= 0)
                                AND (SUM((CASE
                                WHEN (`cpe_bd`.`u`.`id` = 4) THEN `cpe_bd`.`hw`.`points`
                                ELSE 0
                            END)) <= 0)),
                            SUM((CASE
                                WHEN (`cpe_bd`.`u`.`id` = 1) THEN `cpe_bd`.`hw`.`points`
                                ELSE 0
                            END)),
                            0)))) AS `promedio`,
            (`cpe_bd`.`ss`.`score_subject` * 1) AS `total`,
            `cpe_bd`.`ss`.`student_id` AS `student_id`,
            `cpe_bd`.`ss`.`cycle_id` AS `cycle_id`,
            `cpe_bd`.`ss`.`coursegrade_id` AS `coursegrade_id`,
            `cpe_bd`.`cg`.`employee_id` AS `employee_id`
        FROM
            ((((((`cpe_bd`.`subjectstudent` `ss`
            JOIN `cpe_bd`.`coursegrade` `cg` ON ((`cpe_bd`.`ss`.`coursegrade_id` = `cpe_bd`.`cg`.`id`)))
            JOIN `cpe_bd`.`course` `c` ON ((`cpe_bd`.`cg`.`course_id` = `cpe_bd`.`c`.`id`)))
            LEFT JOIN `cpe_bd`.`homework` `hw` ON ((`cpe_bd`.`ss`.`id` = `cpe_bd`.`hw`.`subjectstudent_id`)))
            LEFT JOIN `cpe_bd`.`unit` `u` ON ((`cpe_bd`.`hw`.`unit_id` = `cpe_bd`.`u`.`id`)))
            LEFT JOIN `cpe_bd`.`pensum` `p` ON (((`cpe_bd`.`p`.`course_id` = `cpe_bd`.`cg`.`course_id`)
                AND (`cpe_bd`.`p`.`grade_id` = `cpe_bd`.`cg`.`grade_id`))))
            JOIN `cpe_bd`.`pensumcoursegroup` `pcg` ON ((`cpe_bd`.`pcg`.`id` = `cpe_bd`.`p`.`pensumcoursegroup_id`)))
        GROUP BY `cpe_bd`.`c`.`id` , `cpe_bd`.`c`.`name` , `cpe_bd`.`ss`.`student_id` , `cpe_bd`.`ss`.`cycle_id` , `cpe_bd`.`ss`.`coursegrade_id` , `cpe_bd`.`cg`.`employee_id` , `cpe_bd`.`p`.`courseorder` , `cpe_bd`.`ss`.`id` , `cpe_bd`.`p`.`pensumcoursegroup_id` , `cpe_bd`.`pcg`.`name`
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
        //
    }
}
