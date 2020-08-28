<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    //

    protected $table = 'caregiver';

    
    public function student() {

        return $this->belongsTo('App\Student', 'student_id');
    }


}
