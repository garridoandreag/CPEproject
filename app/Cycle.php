<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    //
    protected $table = 'cycle';
    
    // uno a muchos
    public function subject(){

        return $this->hasMany('App\Subject','cycle_id','id');
    }    

    // muchos a uno
    public function school() {
        return $this->belongsTo('App\School','school_id');
    }
    
    // uno a muchos
    public function calendar(){

        return $this->hasMany('App\Calendar','cycle_id','id');
    }    

    // uno a muchos
    public function announcement(){

        return $this->hasMany('App\Announcement','cycle_id','id');
    }    

    
}
