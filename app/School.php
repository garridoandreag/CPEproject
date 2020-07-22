<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    
        protected $table = 'school';
    
    // uno a muchos
    public function cycle(){

        return $this->hasMany('App\Cycle','school_id','id');
    }    
}
