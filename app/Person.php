<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    //
    protected $table = 'person';

    // uno a muchos
    public function user() {

        return $this->hasMany('App\User', 'person_id', 'id');
    }

    // uno a uno
    public function employee() {

        return $this->hasOne('App\Employee', 'id', 'id');
    }

//    public function person_employee() {
//
//        return $this->belongsTo('App\Employee', 'id');
//    }

    // uno a uno
    public function student() {

        return $this->hasOne('App\Student', 'id', 'id');
    }

    // uno a uno
    public function tutor() {

        return $this->hasOne('App\Tutor', 'id', 'id');
    }


    // muchos a uno
    public function gender() {

        return $this->belongsTo('App\Gender', 'gender_id');
    }

//    
}
