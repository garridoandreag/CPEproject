<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Homework;

class Homeworks {
    
    public function get(){
        
      $user = \Auth::user();
        
      $id = $user->person_id;

        $homeworks = DB::table('homework')
                      ->join('activity','homework.activity_id','activity.id')
                      ->join('coursegrade','activity.coursegrade_id','coursegrade.id')
                      ->join('course','coursegrade.course_id','course.id')
                      ->where('coursegrade.employee_id','like',$id)
                      ->where('coursegrade.cycle_id','like',3)
                      ->select('course.name as asignatura',DB::Raw('COUNT(homework.id) cantidad'))
                      ->groupBy('course.name')
                      ->get();

        return $homeworks;
    }
}