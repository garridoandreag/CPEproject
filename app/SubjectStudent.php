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
    public function grade() {
        return $this->belongsTo('App\Grade','grade_id','id');
    }
    
    // muchos a uno
    public function coursegrade() {
        return $this->belongsTo('App\Coursegrade','coursegrade_id','id');
    }
    
    // muchos a uno
    public function cycle() {
        return $this->belongsTo('App\Cycle','cycle_id','id');
    }
    
        // muchos a uno
    public function student() {
        return $this->belongsTo('App\Student','student_id','id');
    }
    
}
