<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
//       Schema::create('student', function (Blueprint $table) {
//          //
//          $table->increments('id_estudiante');
//          $table->string('codigo_estudiante',100);
//          $table->string('nombre1',100);
//          $table->string('nombre2',100);
//          $table->string('nombre3',100);
//          $table->string('apellido1',100);
//          $table->string('apellido2',100);
//          $table->string('email',100);
//          $table->enum('estado',['ACTIVO','INACTIVO']);
//
//          });




//        DB::statement("
//            CREATE TABLE estudiante(
//            id int(255) auto_increment not null,
//            codigo_estudiante varchar(100),
//            nombre1 varchar(100) not null,
//            nombre2 varchar(100),
//            nombre3 varchar(100),
//            apellido1 varchar(100) not null,
//            apellido2 varchar(100) not null,
//            fecha_nacimiento date not null,
//            fecha_inscripcion date not null,
//            email varchar (191),
//            user_id bigint(20) unsigned,
//            usuario boolean default 0,
//            estado enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
//            created_at datetime,
//            updated_at datetime,
//            CONSTRAINT pk_estudiante PRIMARY KEY(id),
//            CONSTRAINT uq_codigo_estudiante UNIQUE(codigo_estudiante)
//            )ENGINE=InnoDb;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('estudiante');
//        Schema::drop('estudiante_encargado');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
