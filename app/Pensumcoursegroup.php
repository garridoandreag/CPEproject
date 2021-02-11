<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pensumcoursegroup extends Model
{
    use sortable;

    protected $table = 'Pensumcoursegroup';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public $sortable = ['name'];

    // uno a muchos
    public function pensum(){

        return $this->hasMany('App\Pensum','pensumcoursegroup_id','id');
    }  

}
