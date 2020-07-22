<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = 'unit';
    
   // uno a muchos
    public function activity() {

        return $this->hasMany('App\Activity','unit_id','id');
    }    
    
    // uno a muchos
    public function homework() {

        return $this->hasMany('App\Homework','unit_id','id');
    }  
    
}
