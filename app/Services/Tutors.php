<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class Tutors {
    
    public function get($id){
        
        $tutors = DB::table('studenttutor')
                    ->join('person','studenttutor.tutor_id','person.id')
                    ->where('studenttutor.student_id', '=', $id)
                    ->select('person.names')
                    ->get();
        

        return compact('tutors');
    }
}
