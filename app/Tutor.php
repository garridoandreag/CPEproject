<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Tutor extends Model {

    use Sortable;

    protected $table = 'tutor';

    protected $primaryKey = 'id';

    protected $fillable = ['dpi','occupation'];

    public $sortable =['dpi','occupation'];
   
    //Uno a uno
    public function person() {

        return $this->belongsTo('App\Person', 'id', 'id');
    }

   /* public function student() {
        return $this->belongsToMany('App\Student', 'StudentTutor', 'student_id', 'tutor_id');
    }*/

    public function student() {
        return $this->belongsToMany('App\Student', 'Studenttutor', 'student_id', 'tutor_id');
    }

}
