<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    //
    protected $table = 'gender';
        // uno a muchos
    public function person() {

        return $this->hasMany('App\Person','gender_id','id');
    }
}
