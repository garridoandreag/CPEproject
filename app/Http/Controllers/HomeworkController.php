<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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

        $homeworks = Homework::sortable()->paginate(30);

        foreach ($subjectstudents as $index => $subjectstudent){
            
            $homeworks=Homework::firstOrCreate(
                ['activity_id' =>  $activity_id],
                ['subjectstudent_id' => $subjectstudent->id,'student_id' => $subjectstudent->student_id, 'unit_id' => $activity->unit_id]
            )->sortable()->paginate(30);;
        };

        return view('homework.index', compact('homeworks'));
    }

    public function detail($id){

    }

}
