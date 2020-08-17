<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    //
    protected $table = 'student';

    public function person() {

        return $this->belongsTo('App\Person', 'id','id');
    }

//    public function person() {
//
//        return $this->hasOne('App\Person', 'id', 'id');
//    }

    public function tutor() {
        return $this->belongsToMany('App\Tutor', 'StudentTutor', 'student_id', 'tutor_id');
    }
    
    public function grade() {
        return $this->belongsToMany('App\Grade');
    }
}
