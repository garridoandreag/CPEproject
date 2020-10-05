<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PaymentCategory extends Model
{
    //
    use Sortable;

    protected $table = 'paymentcategory';

    protected $primaryKey = 'id';

    protected $fillable = ['name','description','payment_date','amount','status'];

    public $sortable =['name','description','payment_date','amount','status'];
    
    // uno a muchos
    public function payment(){

        return $this->hasMany('App\Payment','paymentcategory_id','id');
    }    
    
    
}
