<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SubjectStudent extends Model
{
    use Sortable;
    
    protected $table = 'subjectstudent';

    protected $primaryKey = 'id';

    protected $fillable = ['student_id','coursegrade_id','grade_id','cycle_id','score_subject','status'];

    public $sortable = ['student_id','coursegrade_id','grade_id','cycle_id','score_subject','status'];
    
    // uno a muchos
    public function homework() {

        return $this->hasMany('App\Homework','subjectstudent_id','id');
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
    
        // muchos a uno
    public function student() {
        return $this->belongsTo('App\Student','student_id','id');
    }
    
}
