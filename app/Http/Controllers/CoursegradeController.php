<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Coursegrade; 
use App\Person; 

class CoursegradeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $coursegrades= Coursegrade::sortable()->paginate(30);

        return view('coursegrade.index', compact('coursegrades'));
    }

    public function create(){
        return view('coursegrade.create');
    }

    public function store(Request $request)
    {
        $courses = $request->input('course');

        $data = $request->validate([
            'grade_id' => ['nullable'],
            'course_id' => ['nullable'],
            'cycle_id' => ['nullable'],
            'employee_id' => ['nullable'],           
        ]);


        DB::transaction(function() use ($data,$courses) {

            foreach($courses as $course){
                Coursegrade::create([
                    'cycle_id' =>  $data['cycle_id'],
                    'grade_id' => $data['grade_id'],
                    'course_id' =>  $course,
                    'employee_id' =>  $data['employee_id'],
                ]);
            }
        });
     
        return redirect()->route('coursegrade.index')
                         ->with(['status' => 'Cursos y grados asignados correctamente.']);
    }


    public function detail($id){
        $coursegrade = \App\Coursegrade::where('id', $id)->first();

        return view('coursegrade.detail', [
            'coursegrade' => $coursegrade
        ]);

    }

    public function courseprofessor(){

        $user = \Auth::user();
        
        $id = $user->person_id;


        $coursegrades=Coursegrade::where('employee_id', $id)->firstOrFail()->sortable()->paginate(30);

        return view('courseprofessor.index', compact('coursegrades'));

    }

    public function edit(){

    }

    public function update(){

    }

}
