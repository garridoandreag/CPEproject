<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Subjectstudent, Pensum, Coursegrade}; 

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

    public function inscription($student_id)
    {
        $subjectstudents=Subjectstudent::select('student_id','grade_id','cycle_id')->distinct()->where('student_id', $student_id)->sortable()->paginate(30);

        return view('subjectstudent.inscription', compact('subjectstudents','student_id'));
    }

    public function reportcard($student_id = '')
    {   
       /* $reports = DB::table('subjectstudent')
                        ->join('coursegrade','subjectstudent.coursegrade_id', '=', 'coursegrade.id')
                        ->join('course','coursegrade.course_id', '=', 'course.id')
                        ->leftJoin('homework','subjectstudent.id', '=', 'homework.subjectstudent_id')
                        ->leftJoin('unit','homework.unit_id', '=', 'unit.id')
                        ->select('course.name','unit.name as unit', DB::raw('SUM(homework.points) as score'))
                        ->where('subjectstudent.student_id','like',$student_id)
                        ->groupBy('course.name','unit.name')
                        ->get();

   */

  $reports = DB::table('reportcard')
                ->where('reportcard.student_id','like',$student_id)
                ->get();
                        



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
        $grade_id = $request->input('grade_id');
        $cycle_id = $request->input('cycle_id');
        $student_id = $request->input('student_id');

        $data = $request->validate([
            'grade_id' => ['required'],
            'cycle_id' => ['required'],     
        ]);


        foreach(Coursegrade::where('grade_id',$grade_id)->where('cycle_id',$cycle_id)->cursor() as $coursegrade){
            Subjectstudent::create([
                'student_id' =>  $student_id,
                'grade_id' => $data['grade_id'],
                'coursegrade_id' => $coursegrade->id,
                'cycle_id' =>  $data['cycle_id']
            ]);
        }

        
     
        return redirect()->action('SubjectstudentController@inscription', ['student_id' => $student_id]) 
                         ->with(['status' => 'Inscripción registrada con éxito.']);
    }

    public function detail($student_id,$cycle_id,$grade_id)
    {
        $subjectstudent=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->first();

        return view('subjectstudent.detail', [
            'student_id' => $student_id,'subjectstudent' => $subjectstudent
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($student_id,$cycle_id,$grade_id)
    {
        try{
                $subjectstudents = DB::table('Subjectstudent')
                                    ->where([
                                        ['student_id','=',$student_id],
                                        ['cycle_id','=', $cycle_id],
                                        ['grade_id','=',$grade_id],
                                        ])->sharedLock()->get();
                //var_dump($subjectstudents);
                //die();

                $subjectstudents->delete();

          }catch(\Exception $e){
              return redirect()->action('SubjectstudentController@inscription', ['student_id' => $student_id]) 
              ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
          }
      
          return redirect()->action('SubjectstudentController@inscription', ['student_id' => $student_id]) 
                          ->with(['status' => 'Se elimino el registro.']);
    }
      
}

