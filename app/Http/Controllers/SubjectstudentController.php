<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{SubjectStudent, Coursegrade, School}; 

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
        $subjectstudents=SubjectStudent::select('student_id','grade_id','cycle_id')->distinct()->where('student_id', $student_id)->sortable()->paginate(30);

        return view('subjectstudent.inscription', compact('subjectstudents','student_id'));
    }


    public function reportcardPDF($cycle_id='',$student_id=''){

        try{

            $school = School::find(1);

        $student = DB::table('person')->where('id','like',$student_id)->get();

        $reports = DB::table('reportcard')
        ->where('reportcard.student_id','like',$student_id)
        ->where('reportcard.cycle_id','like',$cycle_id)
        ->orderBy('reportcard.id','asc')
        ->get();

        
        $professor= DB::table('reportprofessor')
        ->join('person','reportprofessor.employee_id','person.id')
        ->where('reportprofessor.student_id','like',$student_id)
        ->where('reportprofessor.cycle_id','like',$cycle_id)
        ->get();

        $subject = Subjectstudent::where('cycle_id',$cycle_id)->where('student_id',$student_id)->first();
        $grade = $subject->coursegrade->grade;
        $cycle= $subject->coursegrade->cycle;


        $pdf = \PDF::loadView('/report/reportcardpdf',compact('reports','school','student','professor','grade','cycle'));
        }catch(\Exception $e){
            return redirect()->action('SubjectstudentController@reportcard', ['cycle_id' => $cycle_id,'student_id' => $student_id]) 
                          ->with(['warning' => 'No hay datos']);
        }
        
        return $pdf->download('boletaNotas.pdf');
    }

    public function reportcard($cycle_id='',$student_id='')
    {   
        $reports = DB::table('reportcard')
                        ->where('reportcard.student_id','like',$student_id)
                        ->where('reportcard.cycle_id','like',$cycle_id)
                        ->orderBy('reportcard.id','asc')
                        ->get();


        $student = DB::table('person')->where('id','like',$student_id)->get();

        $professor= DB::table('reportprofessor')
        ->join('person','reportprofessor.employee_id','person.id')
        ->where('reportprofessor.student_id','like',$student_id)
        ->where('reportprofessor.cycle_id','like',$cycle_id)
        ->get();

        try{
            $subject = Subjectstudent::where('cycle_id',$cycle_id)->where('student_id',$student_id)->first();
            $grade = $subject->coursegrade->grade;
            $cycle= $subject->coursegrade->cycle;
        }catch(\Exception $e){
            $grade = '';
            $cycle= '';
        }
                        
        return view('subjectstudent.reportcard', compact('reports','student_id','cycle_id','student','professor','grade','cycle'));
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
            SubjectStudent::create([
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

