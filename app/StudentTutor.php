<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTutor extends Model {

    //

    protected $table = 'studenttutor';

    public function payment_student() {
        return $this->hasMany('App\Payment','student_id','student_id');
    }

    public function payment_tutor() {
        return $this->hasMany('App\Payment','tutor_id','tutor_id');
    }

    // muchos a uno
    public function student() {
        return $this->belongsTo('App\Student','student_id');
    }  
    
    // muchos a uno
    public function tutor() {
        return $this->belongsTo('App\Tutor','tutor_id');
    }  
}
