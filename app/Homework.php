<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Homework extends Model
{
    use Sortable;
    
    protected $table = 'homework';

    protected $primaryKey = 'id';

    protected $fillable = ['activity_id','subjectstudent_id','student_id','unit_id'];

    public $sortable =['activity_id','subjectstudent_id','student_id','unit_id'];
    
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
