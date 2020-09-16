<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Subjectstudent;
Use App\Homework;
Use App\Activity;

class HomeworkController extends Controller
{
    
    public function create($activity_id)
    {
        $activity = Activity::where('id', $activity_id)->first();

        $subjectstudents = Subjectstudent::where('coursegrade_id', $activity->coursegrade_id)->get();

        foreach ($subjectstudents as $index => $subjectstudent){
            
            $homeworks=Homework::firstOrCreate(
                ['activity_id' =>  $activity_id,'subjectstudent_id' => $subjectstudent->id],
                ['student_id' => $subjectstudent->student_id, 'unit_id' => $activity->unit_id]
            )->sortable()->paginate(30);
        };

        $homeworks = Homework::where('activity_id', $activity_id)->sortable()->paginate(30);

        return view('homework.index', compact('homeworks'));
    }

    public function detail($id){

    }

    public function homeworkcourse($coursegrade_id){//no funciona aún

        $coursegrade = Subjectstudent::where('coursegrade_id', $coursegrade_id)->get();
        $subjectstudents = Subjectstudent::where('coursegrade_id', $coursegrade_id)->get();

        $activities = Activity::where('coursegrade_id', $coursegrade_id)->orderBy('id', 'ASC')->get();


        foreach($activities as $activity){
            foreach ($subjectstudents as $subjectstudent){
            
                $homeworks=Homework::firstOrCreate(
                    ['activity_id' =>  $activity->id,'subjectstudent_id' => $subjectstudent->id],
                    ['student_id' => $subjectstudent->student_id, 'unit_id' => $activity->unit_id]
                )->sortable()->paginate(30);
            };
        }

        return view('homework.course', compact('homeworks','activities','subjectstudents'));


    }


    public function update(Request $request) {

  
        

        return redirect()->action('CoursegradeController@courseprofessor')->with('status', 'Estudiante actualizado correctamente');

    }

}
