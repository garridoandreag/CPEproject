<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    // muchos a uno
    public function employee() {

        return $this->belongsTo('App\Employee','employee_id');
    }
    
    // muchos a uno
    public function grade() {
        return $this->belongsTo('App\Grade','grade_id');
    }
    
    // muchos a uno
    public function course() {
        return $this->belongsTo('App\Course','course_id');
    }
    
    // muchos a uno
    public function cycle() {
        return $this->belongsTo('App\Cycle','cycle_id');
    }
    
    // uno a muchos
    public function activity_grade() {

        return $this->hasMany('App\Activity','grade_id','grade_id');
    }
    
    // uno a muchos
    public function activity_course() {

        return $this->hasMany('App\Activity','course_id','course_id');
    }
    
    // uno a muchos
    public function activity_cycle() {

        return $this->hasMany('App\Activity','cycle_id','cycle_id');
    }
    
        // uno a muchos
    public function subjetstudent_grade() {

        return $this->hasMany('App\SubjetStudent','grade_id','grade_id');
    }
    
    // uno a muchos
    public function subjetstudent_course() {

        return $this->hasMany('App\SubjetStudent','course_id','course_id');
    }
    
    // uno a muchos
    public function subjetstudent_cycle() {

        return $this->hasMany('App\SubjetStudent','cycle_id','cycle_id');
    }
}
