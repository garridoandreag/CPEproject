<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Job extends Model
{
    use Sortable;
    
    protected $table = 'job';

    protected $primaryKey = 'id';

    protected $fillable = ['job','status'];

    public $sortable = ['job','status'];
    
    // uno a muchos
    public function employee(){

        return $this->hasMany('App\Employee','job_id','id');
    }  
    
}
