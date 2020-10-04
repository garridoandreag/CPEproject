<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Subjectstudent, Homework}; 

class SubjectstudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $subjectstudents= Subjectstudent::sortable()->paginate(30);

        return view('subjectstudent.index', compact('subjectstudents'));
    }

    public function reportcard($student_id = '')
    {
        $reports = DB::table('homework')
                        ->join('person','homework.student_id', '=', 'person.id')
                        ->join('activity','homework.activity_id', '=', 'activity.id')
                        ->rightJoin('unit','activity.unit_id', '=', 'unit.id')
                        ->join('coursegrade','activity.coursegrade_id', '=', 'coursegrade.id')
                        ->join('course','coursegrade.course_id', '=', 'course.id')
                        ->select('course.name', DB::raw('SUM(homework.points) as score'),'unit.name as unit','coursegrade.cycle_id','person.names')
                        ->where('homework.student_id','like',$student_id)
                        ->groupBy('course.name','unit.name','coursegrade.cycle_id','person.names')
                        ->get();
        //$reports = Homework::where('student_id', $student_id )->first();
        

        return view('subjectstudent.reportcard', compact('reports'));
    }

    public function create($student_id)
    {
                return view('subjectstudent.create', [
                    'student_id' => $student_id
                ]);
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
