<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'payment';
    
    // muchos a uno
    public function student() {
        return $this->belongsTo('App\StudentTutor','student_id');
    }     
    
        // muchos a uno
    public function tutor() {
        return $this->belongsTo('App\StudentTutor','tutor_id');
    }     
    
        // muchos a uno
    public function paymentcategory() {
        return $this->belongsTo('App\PaymentCategory','paymentcategory_id');
    }     
    
}
