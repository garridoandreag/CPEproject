<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Activity extends Model
{
    use Sortable;
    
    protected $table = 'activity';
    
    protected $primaryKey = 'id';

    protected $fillable = ['unit_id','coursegrade_id','name','description','score','delivery_date','status'];

    public $sortable = ['unit_id','coursegrade_id','name','description','score','delivery_date','status'];

    // uno a muchos
    public function homework() {

        return $this->hasMany('App\Homework','activity_id','id');
    }
    
    
    // muchos a uno
    public function unit() {
        return $this->belongsTo('App\Unit','unit_id','id');
    }
    
    // muchos a uno
    public function coursegrade() {
        return $this->belongsTo('App\Coursegrade','coursegrade_id','id');
    }
    
    
}
