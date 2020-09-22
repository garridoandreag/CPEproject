<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE ACTIVITY(
            id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
            unit_id int(255) UNSIGNED NOT NULL,
            coursegrade_id int(255) UNSIGNED NOT NULL,
            name varchar(100) NOT NULL,
            description varchar(100),
            score decimal(10,0) not null default '0',
            type enum('Zona','Evaluacion') not null default 'Zona',
            delivery_date date,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_activity PRIMARY KEY (id),
            CONSTRAINT fk_activity_unit FOREIGN KEY (unit_id) REFERENCES unit(id),
            CONSTRAINT fk_activity_coursegrade FOREIGN KEY (coursegrade_id) REFERENCES coursegrade(id)
            )ENGINE=InnoDb;
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
