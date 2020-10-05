<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Announcement extends Model
{
    use Sortable;

    protected $table = 'announcement';

    protected $primaryKey = 'id';

    protected $fillable = ['title','description','start_time','end_time', 'cycle_id', 'status'];

    public $sortable = ['title','description','start_time','end_time', 'cycle_id', 'status'];
    
    // muchos a uno
    public function cycle() {
        return $this->belongsTo('App\Cycle','cycle_id');
    }    
}
