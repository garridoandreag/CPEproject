<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    //
    protected $table = 'calendar';
    
    // muchos a uno
    public function cycle() {
        return $this->belongsTo('App\Cycle','cycle_id');
    }    
    
}
