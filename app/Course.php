<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'course';
    
    // uno a muchos
    public function subject(){

        return $this->hasMany('App\Subject','course_id','id');
    }    
}
