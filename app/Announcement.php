<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    protected $table = 'announcement';
    
    // muchos a uno
    public function cycle() {
        return $this->belongsTo('App\Cycle','cycle_id');
    }    
}
