<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Course extends Model
{
    //
    protected $table = 'course';
        
    protected $primaryKey = 'id';

    protected $fillable = ['id','name','status'];

    public $sortable = ['id','name','status'];
    
    // uno a muchos
    public function coursegrade(){

        return $this->hasMany('App\Coursegrade','course_id','id');
    }    
}
