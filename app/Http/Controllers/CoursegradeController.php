<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Coursegrade; 

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
        $courses = $request->input('course_id');

        $data = $request->validate([
            'grade_id' => ['required'],
            'course_id' => ['required'],
            'cycle_id' => ['required'],
            'employee_id' => ['required'],           
        ]);

        Coursegrade::create([
            'grade_id' => ['grade_id'],
            'cycle_id' => ['cycle_id'],
            'employee_id' => ['employee_id'],
            'course_id' => ['course_id'],
        ]);
     
        return redirect()->route('coursegrade.index')
                        ->with(['status' => 'Cursos y grados asignados correctamente.']);
    }
    public function detail(){

    }

    public function edit(){

    }

    public function update(){

    }

}
