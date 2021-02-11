<?php

use Illuminate\Database\Seeder;

class PaymentcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('paymentcategory')->insert(array(
            'id' => 1,
            'name' => 'Inscripcion',
            'description' => 'Inscripcion',
            'payment_date' => date('2020/01/01'),
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 2,
            'name' => 'Colegiatura Enero ',
            'description' => 'Colegiatura Enero',
            'payment_date' => '2020/01/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 3,
            'name' => 'Colegiatura Febrero ',
            'description' => 'Colegiatura Febrero',
            'payment_date' => '2020/02/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 4,
            'name' => 'Colegiatura Marzo ',
            'description' => 'Colegiatura Febrero',
            'payment_date' => '2020/03/05',
            'amount' => '300.00'
        ));

        
        DB::table('paymentcategory')->insert(array(
            'id' => 5,
            'name' => 'Colegiatura Abril ',
            'description' => 'Colegiatura Abril',
            'payment_date' => '2020/04/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 6,
            'name' => 'Colegiatura Mayo ',
            'description' => 'Colegiatura Mayo',
            'payment_date' => '2020/05/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 7,
            'name' => 'Colegiatura Junio ',
            'description' => 'Colegiatura Junio',
            'payment_date' => '2020/06/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 8,
            'name' => 'Colegiatura Julio ',
            'description' => 'Colegiatura Julio',
            'payment_date' => '2020/07/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 9,
            'name' => 'Colegiatura Agosto',
            'description' => 'Colegiatura Agosto',
            'payment_date' => '2020/08/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 10,
            'name' => 'Colegiatura Septiembre',
            'description' => 'Colegiatura Septiembre',
            'payment_date' => '2020/09/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 11,
            'name' => 'Colegiatura Octubre',
            'description' => 'Colegiatura Septiembre',
            'payment_date' => '2020/10/05',
            'amount' => '300.00'
        ));

        DB::table('paymentcategory')->insert(array(
            'id' => 12,
            'name' => 'Colegiatura Noviembre',
            'description' => 'Colegiatura Noviembre',
            'payment_date' => '2020/11/05',
            'amount' => '300.00'
        ));

        
        DB::table('paymentcategory')->insert(array(
            'id' => 13,
            'name' => 'Colegiatura Diciembre',
            'description' => 'Colegiatura Diciembre',
            'payment_date' => '2020/12/05',
            'amount' => '300.00'
        ));

    }
}
