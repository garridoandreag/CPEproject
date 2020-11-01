<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Liststudent extends Model
{
    
    use Sortable;
    
    protected $table = 'liststudent';

    public $sortable = ['id','student_code','names','first_surname','second_surname','cycle_id','cycle','grade_id','grade','picture'];
}
