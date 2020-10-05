<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Coursegrade, Activity};

class ActivityController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $activities = \App\activity::sortable()->paginate(30);

        return view('activity.index', compact('activities'));
    }

    public function create($employee_id)
    {
        
        return view('activity.create', compact('employee_id'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'unit_id' => ['required'],
            'coursegrade_id' => ['required'],
            'name' => ['required', 'string','max:50'],
            'description' => ['required','string','max:900'],
            'score' => ['required'],
            'type' => ['required'],
            'delivery_date' => ['required','date'],
        ]);

        $coursegrade_id = $data['coursegrade_id'];
        Activity::create([
            'unit_id' => $data['unit_id'],
            'coursegrade_id' => $data['coursegrade_id'],
            'name' => $data['name'],
            'description'=> $data['description'],
            'score' => $data['score'],
            'type' => $data['type'],
            'delivery_date'=> $data['delivery_date'],
        ]);
     
        return redirect()->route('courseprofessor.activity', compact('coursegrade_id'))
                        ->with(['status' => 'Actividad agregada correctamente.']);
    }

    public function courseprofessoractivity($coursegrade_id, $unit_id = '')
    {

        $coursegradeprof = Coursegrade::where('id', $coursegrade_id)->first();
        $grade_name = $coursegradeprof->grade->name;
        $course_name = $coursegradeprof->course->name;
        $employee_id = $coursegradeprof->employee_id;

        try{
            if(empty($unit_id)){

                $activities=Activity::where('coursegrade_id', $coursegrade_id)->sortable()->paginate(10);
            }else{
                $activities=Activity::where('coursegrade_id', $coursegrade_id)->where('unit_id',$unit_id)->sortable()->paginate(10);

            }
        }catch(\Exception $e){
            return view('courseprofessor.activity',compact('coursegrade_id','grade_name','course_name'));
        }

        return view('courseprofessor.activity', compact('coursegrade_id','activities','grade_name','course_name','employee_id'));
    }

    public function edit($id)
    {
        $activity = \App\Activity::where('id', $id)->first();
        $employee_id = $activity->coursegrade->employee_id;
        $coursegrade_id = $activity->coursegrade_id;

        return view('activity.create', [
            'activity' => $activity,
            'employee_id' => $employee_id,
            'coursegrade_id'=> $coursegrade_id
        ]);
    }

    public function update(Request $request)
    {       
        $id = $request->input('id');
        $activity = Activity::find($id);
        
        $data = $request->validate([
            'unit_id' => ['required'],
            'coursegrade_id' => ['required'],
            'name' => ['required', 'string','max:50'],
            'description' => ['required','string','max:900'],
            'score' => ['required'],
            'type' => ['required'],
            'delivery_date' => ['required','date'],
        ]);

        $coursegrade_id = $data['coursegrade_id'];
        $activity->unit_id =  $data['unit_id'];
        $activity->coursegrade_id =  $data['coursegrade_id'];
        $activity->name =  $data['name'];
        $activity->description =  $data['description'];
        $activity->score =  $data['score'];
        $activity->type =  $data['type'];
        $activity->delivery_date =  $data['delivery_date'];

        $activity->update();
     
        return redirect()->route('courseprofessor.activity', compact('coursegrade_id'))
                        ->with(['status' => 'Actividad actualizada correctamente.']);

    }

    public function detail($id)
    {
        $activity = \App\Activity::where('id', $id)->first();
        $employee_id = $activity->coursegrade->employee_id;
        $coursegrade_id = $activity->coursegrade_id;

        return view('activity.detail', [
            'activity' => $activity,
            'employee_id' => $employee_id,
            'coursegrade_id'=> $coursegrade_id
        ]);
    }
}
