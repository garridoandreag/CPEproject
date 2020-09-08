<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Caregiver extends Model
{
    use Sortable;
    
    protected $table = 'caregiver';

    protected $primaryKey = 'id';

    protected $fillable = ['name','surname','relationship','phone_number'];

    public $sortable = ['name','surname','relationship','phone_number'];
    
    public function student() {

        return $this->belongsTo('App\Student', 'student_id');
    }


}
