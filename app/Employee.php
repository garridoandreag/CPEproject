<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Employee extends Model
{   
    use Sortable;
    
    protected $table = 'employee';

    protected $primaryKey = 'id';

    protected $fillable = ['dpi','job_id','salary','professor','status'];

    public $sortable = ['dpi','job_id','salary','professor','status'];
    
           // uno a uno
    public function person() {

        return $this->belongsTo('App\Person','id','id');
    }
    
        // uno a muchos
    public function subject() {

        return $this->hasMany('App\Subject','employee_id','id');
    }

        // muchos a uno
    public function job() {
        return $this->belongsTo('App\Job','job_id');
    }
    
}
