<?php

namespace App\Services;
use App\Coursegrade;

class Courseprofessors {
    
    public function get($employee_id, $coursegrade_id = ''){

        if(empty($coursegrade_id)){
            $coursegrades = Coursegrade::get()->where('employee_id',$employee_id)->where('status','ACTIVO');
        }else{
            $coursegrades = Coursegrade::get()
                            ->where('employee_id',$employee_id)
                            ->where('id',$coursegrade_id)
                            ->where('status','ACTIVO');
        }
        
      

        $coursegradesArray['']='Selecciona un curso';

        foreach($coursegrades as $coursegrade){
            $coursegradesArray[$coursegrade->id] = $coursegrade->course->name.' '.$coursegrade->grade->name.' ('.$coursegrade->cycle->name.')';
        }
        return $coursegradesArray;
    }



}