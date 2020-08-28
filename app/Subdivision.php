<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    //
    protected $table = 'subdivision';

        // muchos a uno
        public function country() {
            return $this->belongsTo('App\Country','country_code','code');
        }

        public function person() {

            return $this->hasMany('App\Person','subdivision_code','code');
        }
}
