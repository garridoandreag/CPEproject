<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'course';
    
    // uno a muchos
    public function coursegrade(){

        return $this->hasMany('App\Coursegrade','course_id','id');
    }    
}
