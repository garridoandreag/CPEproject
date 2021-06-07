<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Payment, Paymentcategory};

class Payments {

    public function getDishonor(){


            $nopayments = DB::select("select s.id, s.student_code, p.names, p.first_surname, p.second_surname
            from student s 
            inner join person p on s.id=p.id
            where s.id not in 
            (select student_id from payment pay
            inner join paymentcategory pc on pc.id=pay.paymentcategory_id
            where pay.cycle_id like 3
            and pc.id like ?
            and Date_format(PC.PAYMENT_DATE,'%d/%M') <= Date_format(now(),'%d/%M')
            )",  [1] );




        return $nopayments;
    }

    public function getPayments(){


        $payments = DB::select("select payc.name , count(pay.student_id) cantidad from student s
        inner join payment pay on s.id=pay.student_id
        inner join paymentcategory payc on payc.id=pay.paymentcategory_id
        group by payc.name");

    return $payments;
}

public function getMonthPayments(){
    $payments = DB::select("select name, Date_format(pc.payment_date,'%d/%M') date from paymentcategory pc
    where Date_format(pc.payment_date,'%M') = Date_format(now(),'%M')");

return $payments;
}

public function getExist($code){
    $payments = DB::table('payment')
                ->select(DB::raw('count(*)'))
                ->where('code_reference',$code)
                ->get();

    return $payments;
}

}