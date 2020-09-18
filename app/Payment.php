<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Payment extends Model
{
    use Sortable;

    protected $table = 'payment';

    protected $primaryKey = 'id';

    protected $fillable = ['paymentcategory_id','cycle_id','amount','code_reference','student_id','tutor_id','status'];

    public $sortable =['paymentcategory_id','cycle_id','amount','code_reference','student_id','tutor_id','status'];
    
    // muchos a uno
    public function studenttutor_student() {
        return $this->belongsTo('App\StudentTutor','student_id','student_id');
    }     
    
        // muchos a uno
    public function studenttutor_tutor() {
        return $this->belongsTo('App\StudentTutor','tutor_id','tutor_id');
    }     

    public function cycle() {
        return $this->belongsTo('App\Cycle','cycle_id');
    }   

    
        // muchos a uno
    public function paymentcategory() {
        return $this->belongsTo('App\PaymentCategory','paymentcategory_id','id');
    }     

    public function student() {

        return $this->belongsTo('App\Student', 'student_id','id');
    }
    
        // muchos a uno
    public function tutor() {
        return $this->belongsTo('App\Tutor','tutor_id','id');
    } 
    
}
