<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\{Tutor, Person, Studenttutor, Student};


class TutorController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        //

        $tutors = \App\Tutor::sortable()->paginate(10);

        $students = DB::table('student')
                        ->join('studenttutor', 'student.id', '=', 'studenttutor.student_id')
                        ->join('person', 'student.id', '=', 'person.id')
                        ->get();   


        return view('tutor.index', compact('tutors','students'));
    }

    public function create()
    {
        //
        return view('tutor.create');
    }


    public function store(Request $request)
    {
        $students = sizeof($request->input('student_id'));
        $student_id = $request->input('student_id');
        $relationship = $request->input('relationship');

        $data = $request->validate([
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:8'],
            'cellphone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_name' => ['required'],
            'gender_id' => ['required'],
            'home_address' => ['required', 'string', 'max:250'],
            'dpi' => ['required', 'string', 'max:13'],
            'occupation' => ['required', 'string', 'max:50'],
        ]);

        DB::transaction(function() use ($data,$students, $student_id,$relationship) {
            $person = Person::create([
                'names' => $data['names'],
                'first_surname' => $data['first_surname'],
                'second_surname' => $data['second_surname'],
                'phone_number' => $data['phone_number'],
                'cellphone_number' => $data['cellphone_number'],
                'country_name' => '320',
                'subdivision_name' => $data['subdivision_name'],
                'home_address' => $data['home_address'],
                'gender_id' => $data['gender_id'],
                'tutor' => '1'
            ]);
    
            $person->tutor()->create([
                'dpi' => $data['dpi'],
                'occupation' => $data['occupation']
            ]);

            for($i = 0; $i < $students; $i++){
                Studenttutor::create([
                    'tutor_id' => $person->id,
                    'student_id' => $student_id[$i],
                    'relationship' => $relationship[$i],
                ]);
            }



        });

        return redirect()->route('tutor.index')
        ->with(['status' => 'Estudiante creado correctamente']);

    }


    public function detail($id)
    {
        //
        $tutor = \App\Tutor::where('id', $id)->first();
        //        var_dump($estudiante);
        //        die();
        
                return view('tutor.detail', [
                    'tutor' => $tutor
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

    public function searchTutorByDPI(Request $request) {
        $dpi = $request->input('dpi');
        $persons = [];
  
        if (strlen($dpi) == 0) {
          return $persons;
        }
  
        $persons = DB::table('person')
          ->join('tutor', 'tutor.id', '=', 'person.id')
          ->select('person.id',DB::raw('CONCAT(tutor.dpi ," - ", person.first_surname," ",person.names) as text'))
          ->where('tutor.dpi', 'like', $dpi.'%')
          ->get();
        return $persons;
      }

    public function destroy($id)
    {
        //
    }
}
