<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class StudentTutor extends Model {

    use Sortable;
    
    protected $table = 'studenttutor';

    protected $fillable = ['student_id','tutor_id','relationship','status'];

    public $sortable = ['student_id','tutor_id','relationship','status'];

    public function student() {

        return $this->belongsTo('App\Student', 'student_id','id');
    }

    public function tutor() {

        return $this->belongsTo('App\Tutor', 'tutor_id','id');
    }
}
