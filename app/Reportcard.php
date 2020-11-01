<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Reportcard extends Model
{
    protected $table = 'reportcard';

    use Sortable;

    public $sortable =['name','bloque1','bloque2','bloque3','bloque4','total'];
}
