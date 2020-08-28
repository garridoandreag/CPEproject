<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'country';

    
            public function person() {
    
                return $this->hasMany('App\Person','country_code','code');
            }

                
            public function subdivision() {
    
                return $this->hasMany('App\Subdivision','country_code','code');
            }

}
