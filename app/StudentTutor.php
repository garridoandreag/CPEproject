<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class StudentTutor extends Model {

    use Sortable;
    
    protected $table = 'studenttutor';

    protected $fillable = ['student_id','tutor_id','relationship','status'];

    public $sortable = ['student_id','tutor_id','relationship','status'];

    public function paymentstudent() {
        return $this->hasMany('App\Payment','student_id','student_id');
    }

    public function paymenttutor() {
        return $this->hasMany('App\Payment','tutor_id','tutor_id');
    }

    public function student() {

        return $this->belongsTo('App\Student', 'student_id','id');
    }
}
