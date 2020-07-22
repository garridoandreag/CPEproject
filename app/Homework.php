<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    //
    protected $table = 'homework';
    
            // muchos a uno
    public function student() {
        return $this->belongsTo('App\Student','student_id','id');
    }
            // muchos a uno
    public function subjectstudent() {
        return $this->belongsTo('App\SubjectStudent','subjectstudent_id','id');
    }
    
            // muchos a uno
    public function activity() {
        return $this->belongsTo('App\Activity','activity_id','id');
    }

            // muchos a uno
    public function unit() {
        return $this->belongsTo('App\Unit','activity_id','id');
    }
    
}
