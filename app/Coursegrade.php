<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Coursegrade extends Model
{
    use Sortable;
    
    protected $table = 'Coursegrade';
    
    protected $primaryKey = 'id';

    protected $fillable = ['cycle_id','course_id','grade_id','employee_id','status'];

    public $sortable = ['cycle_id','course_id','grade_id','employee_id','status'];
    
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
    public function activity() {

        return $this->hasMany('App\Activity','coursegrade_id','id');
    }
   
        // uno a muchos
    public function subjetstudent() {

        return $this->hasMany('App\SubjetStudent','coursegrade_id','id');
    }

}
