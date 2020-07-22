<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'employee';
           // uno a uno
    public function person() {

        return $this->belongsTo('App\Person');
    }
    
        // uno a muchos
    public function subject() {

        return $this->hasMany('App\Subject','employee_id','id');
    }
    
}
