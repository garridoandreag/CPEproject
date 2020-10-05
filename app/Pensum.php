<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pensum extends Model
{
    use Sortable;

    protected $table = 'pensum';


    protected $fillable = ['grade_id','course_id'];

}
