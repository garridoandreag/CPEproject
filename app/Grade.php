<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $table = 'grade';
    
    // uno a muchos
    public function subject(){

        return $this->hasMany('App\Subject','grade_id','id');
    }      
}
