<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model {

    //
    protected $table = 'tutor';

    protected $primaryKey = 'id';

    protected $fillable = ['dpi','occupation'];

   


    //Uno a uno
    public function person() {

        return $this->belongsTo('App\Person', 'id', 'id');
    }

    public function student() {
        return $this->belongsToMany('App\Student', 'StudentTutor', 'student_id', 'tutor_id');
    }

}
