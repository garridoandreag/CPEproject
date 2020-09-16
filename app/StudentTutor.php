<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class StudentTutor extends Model {

    use Sortable;
    
    protected $table = 'studenttutor';

    protected $primaryKey = 'id';

    protected $fillable = ['student_id','tutor_id','relationship','status'];

    public $sortable = ['student_id','tutor_id','relationship','status'];

    public function payment_student() {
        return $this->hasMany('App\Payment','student_id','student_id');
    }

    public function payment_tutor() {
        return $this->hasMany('App\Payment','tutor_id','tutor_id');
    }
 
}
