<?php

namespace App\Services;
use App\Role;

class Roles {
    
    public function get(){
        
        $roles = Role::get()->where('status','ACTIVO');
        
        foreach($roles as $role){
            $rolesArray[$role->id] = $role->name;
        }
        return $rolesArray;
    }
}
