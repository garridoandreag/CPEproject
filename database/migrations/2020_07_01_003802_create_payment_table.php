<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE PAYMENT(
            id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
            paymentcategory_id int(255) UNSIGNED NOT NULL,
            cycle_id int(255) UNSIGNED NOT NULL,
            amount decimal(10,2) not null,
            code_reference varchar(100) not null,
            student_id int(255) UNSIGNED NOT NULL,
            tutor_id int(255) UNSIGNED NOT NULL,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
            CONSTRAINT pk_payment PRIMARY KEY (id),
            CONSTRAINT fk_payment_studenttutor1 FOREIGN KEY (student_id) REFERENCES studenttutor(student_id),
            CONSTRAINT fk_payment_studenttutor2 FOREIGN KEY (tutor_id) REFERENCES studenttutor(tutor_id),
            CONSTRAINT fk_payment_paymentcategory FOREIGN KEY (paymentcategory_id) REFERENCES paymentcategory(id)
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
        Schema::dropIfExists('payment');
    }
}
