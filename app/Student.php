<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Student extends Model {

    use Sortable;
    
    protected $table = 'student';

    protected $primaryKey = 'id';

    protected $fillable = ['student_code','birthday'];

    public $sortable = ['student_code','birthday','grade_id'];

    public function person() {

        return $this->belongsTo('App\Person', 'id','id');
    }

    public function tutor() {
        return $this->belongsToMany('App\Tutor', 'Studenttutor', 'student_id', 'tutor_id');
    }
    
    public function grade() {
        return $this->belongsToMany('App\Grade','grade_id');
    }

    public function caregiver() {
    
        return $this->hasMany('App\Caregiver','student_id');
    }


}
