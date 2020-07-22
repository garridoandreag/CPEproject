<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';
    
    // uno a muchos
    public function user(){

        return $this->hasMany('App\User','user_id','id');
    }        
}
