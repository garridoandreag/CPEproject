<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Cycle extends Model
{
    use Sortable;

    protected $table = 'cycle';

    protected $primaryKey = 'id';

    protected $fillable = ['name','school_id','start_date','end_date', 'status','main','current'];

    public $sortable = ['name','school_id','start_date','end_date','status','main','current'];
    
    // uno a muchos
    public function coursegrade(){

        return $this->hasMany('App\Coursegrade','cycle_id','id');
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
