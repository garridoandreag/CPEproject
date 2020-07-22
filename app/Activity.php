<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    
    protected $table = 'activity';

    // uno a muchos
    public function activity() {

        return $this->hasMany('App\Homework','activity_id','id');
    }
    
    
    // muchos a uno
    public function unit() {
        return $this->belongsTo('App\Unit','activity_id','id');
    }
    
    // muchos a uno
    public function subject_grade() {
        return $this->belongsTo('App\Subject','grade_id','grade_id');
    }
    
    // muchos a uno
    public function subject_course() {
        return $this->belongsTo('App\Subject','course_id','course_id');
    }
    
    // muchos a uno
    public function subject_cycle() {
        return $this->belongsTo('App\Subject','cycle_id','cycle_id');
    }
    
}
