<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class School extends Model
{
        use Sortable;

        protected $table = 'school';

        protected $primaryKey = 'id';
    
        protected $fillable = ['name','phone_number','cellphone_number','address','vision','mision','history','facebook_url'];
    
        public $sortable = ['name','phone_number','address'];
    
    // uno a muchos
    public function cycle(){

        return $this->hasMany('App\Cycle','school_id','id');
    }    
}
