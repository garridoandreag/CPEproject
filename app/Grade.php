<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Grade extends Model
{
    //
    use Sortable;
    
    protected $table = 'grade';

    protected $primaryKey = 'id';

    protected $fillable = ['name','section'];

    public $sortable = ['name','section'];
    
    // uno a muchos
    public function coursegrade(){

        return $this->hasMany('App\Coursegrade','grade_id','id');
    }  

    public function student() {

        return $this->hasMany('App\Student', 'grade_id', 'id');
    }    

    public function course()
    {
        return $this->belongsToMany('App\Course', 'pensum', 'grade_id', 'course_id');
    }

        

}
