<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    //
    
        // uno a muchos
    public function person() {

        return $this->hasMany('App\Person','maritalstatus_id','id');
    }
}
