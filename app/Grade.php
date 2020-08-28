<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Grade extends Model
{
    //
    use Sortable;
    
    protected $table = 'grade';

    protected $primaryKey = 'id';

    protected $fillable = ['name','section'];

    public $sortable = ['name','section'];
    
    // uno a muchos
    public function subject(){

        return $this->hasMany('App\Subject','grade_id','id');
    }  

    public function student() {

        return $this->hasMany('App\Student', 'grade_id', 'id');
    }    
}
