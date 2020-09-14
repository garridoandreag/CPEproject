<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable {

    use Notifiable;
    use Sortable;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','person_id','name', 'email', 'password',
    ];

    public $sortable = [
        'role_id','person_id','name', 'email','created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // muchos a uno
    public function person() {
        return $this->belongsTo('App\Person','person_id');
    }
    
    // muchos a uno
    public function role() {
        return $this->belongsTo('App\Role','role_id');
    }

}
