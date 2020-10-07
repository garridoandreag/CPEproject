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
    
    public function edit($activity_id)
    {
        $activity = Activity::where('id', $activity_id)->first();
        $activity_name = $activity->name;
        $activity_description = $activity->description;
        $course_name =  $activity->coursegrade->course->name;
        $grade_name =  $activity->coursegrade->grade->name;

        $coursegrade_id = $activity->coursegrade_id;

        $subjectstudents = Subjectstudent::where('coursegrade_id', $activity->coursegrade_id)->get();

        foreach ($subjectstudents as $index => $subjectstudent){
            
            $homeworks=Homework::firstOrCreate(
                ['activity_id' =>  $activity_id,'subjectstudent_id' => $subjectstudent->id],
                ['student_id' => $subjectstudent->student_id, 'unit_id' => $activity->unit_id]
            )->sortable()->paginate(30);
        };

        $homeworks = Homework::where('activity_id', $activity_id)->sortable()->paginate(30);

        return view('homework.edit', compact('homeworks','coursegrade_id','course_name','grade_name','activity_name','activity_description'));
        //return view('homework.edit', ['homeworks' => $homeworks, 'coursegrade_id' => $coursegrade_id]);
    }

    public function detail($activity_id){
        $activity = Activity::where('id', $activity_id)->first();
        $activity_name = $activity->name;
        $activity_description = $activity->description;
        $course_name =  $activity->coursegrade->course->name;
        $grade_name =  $activity->coursegrade->grade->name;

        $coursegrade_id = $activity->coursegrade_id;

        $subjectstudents = Subjectstudent::where('coursegrade_id', $activity->coursegrade_id)->get();

        foreach ($subjectstudents as $index => $subjectstudent){
            
            $homeworks=Homework::firstOrCreate(
                ['activity_id' =>  $activity_id,'subjectstudent_id' => $subjectstudent->id],
                ['student_id' => $subjectstudent->student_id, 'unit_id' => $activity->unit_id]
            )->sortable()->paginate(30);
        };

        $homeworks = Homework::where('activity_id', $activity_id)->sortable()->paginate(30);

        return view('homework.detail', compact('homeworks','coursegrade_id','course_name','grade_name','activity_id','activity_name','activity_description'));

    }

    public function store(Request $request) {
    }

    public function update(Request $request) {
        $homeworks = sizeof($request->input('id'));
        $id = $request->input('id');
        $activity_id = $request->input('activity_id');
        $points = $request->input('points');
        $PM= $request->input('PM');
        $delivery_date = $request->input('delivery_date');

        $coursegrade_id = $request->input('coursegrade_id');
    
        for($i = 0; $i < $homeworks; $i++){
            Homework::where('id', $id[$i])
            ->update([
                'points' => $points[$i] ,
                'PM'  => $PM[$i],
                'delivery_date' => $delivery_date[$i],
                ]);

        }

        return redirect()->action('ActivityController@courseprofessoractivity', 
        ['coursegrade_id' => $coursegrade_id])
        ->with('status', 'Estudiante actualizado correctamente');

    }

  




}
