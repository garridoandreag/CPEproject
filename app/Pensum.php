<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pensum extends Model
{
    use Sortable;

    protected $table = 'pensum';


    protected $fillable = ['grade_id','course_id'];

        // muchos a uno
        public function grade() {
            return $this->belongsTo('App\Grade','grade_id');
        }
        
        // muchos a uno
        public function course() {
            return $this->belongsTo('App\Course','course_id');
        }

}
