<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model {

    //
    protected $table = 'tutor';
    
    public function person() {

        return $this->hasOne('App\Person', 'id', 'id');
    }

    public function student() {
        return $this->belongsToMany('App\Student', 'StudentTutor', 'student_id', 'tutor_id');
    }

}
