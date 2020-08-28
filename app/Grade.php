<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $table = 'grade';

    protected $primaryKey = 'id';

    protected $fillable = ['name','section'];
    
    // uno a muchos
    public function subject(){

        return $this->hasMany('App\Subject','grade_id','id');
    }  

    public function student() {

        return $this->hasMany('App\Student', 'grade_id', 'id');
    }    
}
