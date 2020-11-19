<?php

namespace App\Services;
use App\PaymentCategory;

class Paymentcategories {
    
    public function get(){
        
        $paymentcategories = Paymentcategory::get()->where('status','ACTIVO');
        $paymentcategoriesArray['']='Selecciona una categoría';
        foreach($paymentcategories as $paymentcategory){
            $paymentcategoriesArray[$paymentcategory->id] = $paymentcategory->name;
        }
        return $paymentcategoriesArray;
    }
}
