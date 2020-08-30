<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    //
    protected $table = 'person';

    protected $primaryKey = 'id';

    protected $fillable = ['names','first_surname','second_surname','favorite_name','phone_number','cellphone_number','home_address','picture','country_code','subdivision_code','gender_id'];


    // uno a muchos
    public function user() {

        return $this->hasMany('App\User', 'person_id', 'id');
    }

    // uno a uno
    public function employee() {

        return $this->hasOne('App\Employee', 'id', 'id');
    }

//    public function person_employee() {
//
//        return $this->belongsTo('App\Employee', 'id');
//    }

    // uno a uno
    public function student() {

        return $this->hasOne('App\Student', 'id', 'id');
    }

    // uno a uno
    public function tutor() {

        return $this->hasOne('App\Tutor', 'id', 'id');
    }


    // muchos a uno
    public function gender() {

        return $this->belongsTo('App\Gender', 'gender_id');
    }

        // muchos a uno
        public function country() {

            return $this->belongsTo('App\Country', 'country_code','code');
        }



            // muchos a uno
    public function subdivision() {

        return $this->belongsTo('App\Subdivision', 'subdivision_code','code');
    }

//    
}
