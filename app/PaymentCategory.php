<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCategory extends Model
{
    //
    
    protected $table = 'paymentcategory';
    
    // uno a muchos
    public function payment(){

        return $this->hasMany('App\Payment','paymentcategory_id','id');
    }    
    
    
}
