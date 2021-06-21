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
        $tutors = \App\Tutor::sortable()->paginate(10);

        $students = DB::table('student')
                        ->join('studenttutor', 'student.id', '=', 'studenttutor.student_id')
                        ->join('person', 'student.id', '=', 'person.id')
                        ->get();   


        return view('tutor.index', compact('tutors','students'));
    }

    public function create()
    {
        return view('tutor.create');
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['nullable', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:8'],
            'cellphone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_code' => ['nullable'],
            'gender_id' => ['required'],
            'home_address' => ['nullable', 'string', 'max:250'],
            'dpi' => ['nullable', 'string', 'regex:/^[1-9]{1}\d{12}/','unique:tutor,dpi,'],
            'occupation' => ['nullable', 'string', 'max:50'],
        ]);

        DB::transaction(function() use ($data) {
            $person = Person::create([
                'names' => $data['names'],
                'first_surname' => $data['first_surname'],
                'second_surname' => $data['second_surname'],
                'phone_number' => $data['phone_number'],
                'cellphone_number' => $data['cellphone_number'],
                'country_code' => '320',
                'subdivision_code' => $data['subdivision_code'],
                'home_address' => $data['home_address'],
                'gender_id' => $data['gender_id'],
                'tutor' => '1'
            ]);
    
            $person->tutor()->create([
                'dpi' => $data['dpi'],
                'occupation' => $data['occupation']
            ]);

        });

        return redirect()->route('tutor.index')
        ->with(['status' => 'Encargado creado correctamente']);

    }


    public function detail($id)
    {
        $tutor = \App\Tutor::where('id', $id)->first();

        $tstudents = DB::table('student')
        ->join('studenttutor', 'student.id', '=', 'studenttutor.student_id')
        ->join('person', 'student.id', '=', 'person.id')
        ->where('studenttutor.tutor_id',$id)
        ->get();  

                return view('tutor.detail', [
                    'tutor' => $tutor,
                    'tstudents' => $tstudents
                ]);
    }


    public function edit($id)
    {
        $tutor = \App\Tutor::where('id', $id)->first();

        $tstudents = DB::table('student')
        ->join('studenttutor', 'student.id', '=', 'studenttutor.student_id')
        ->join('person', 'student.id', '=', 'person.id')
        ->where('studenttutor.tutor_id',$id)
        ->get(); 

                return view('tutor.create', [
                    'tutor' => $tutor,
                    'tstudents' => $tstudents
                ]);
    }


    public function update(Request $request)
    {

        try{
        $id = $request->input('id');
        $person = Person::where('id',$id)->first();
        $tutor =  Tutor::where('id',$id)->first();

        $data = $request->validate([
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['nullable', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:8'],
            'cellphone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_code' => ['nullable'],
            'gender_id' => ['nullable'],
            'home_address' => ['nullable', 'string', 'max:250'],
            'dpi' => ['nullable', 'string', 'regex:/^[1-9]{1}\d{12}/','unique:tutor,dpi,'. $id],
            'occupation' => ['nullable', 'string', 'max:50'],
        ]);

        $person->names =  $data['names'];
        $person->first_surname =  $data['first_surname'];
        $person->second_surname =  $data['second_surname'];
        $person->phone_number =  $data['phone_number'];
        $person->cellphone_number =  $data['cellphone_number'];
        $person->subdivision_code =  $data['subdivision_code'];
        $person->gender_id =  $data['gender_id'];
        $person->home_address =  $data['home_address'];
        $tutor->dpi =  $data['dpi'];
        $tutor->occupation =  $data['occupation'];

        $person->update();
        $tutor->update();


    }catch(\Exception $e){

    }
        return redirect()->action('TutorController@index')->with('status', 'Padre/Encargado actualizado correctamente');


    }

    public function searchTutorBySurname(Request $request) {
        $surname = $request->input('surname');
        $persons = [];
  
        if (strlen($surname) == 0) {
          return $persons;
        }
  
        $persons = DB::table('person')
          ->join('tutor', 'tutor.id', '=', 'person.id')
          ->select('person.id',DB::raw('CONCAT(person.first_surname," ",person.second_surname," ",person.names," - ",IFNULL( tutor.dpi , "")) as text'))
          ->where('person.first_surname', 'like', $surname.'%')
          ->where('tutor.status', 'like', 'ACTIVO')
          ->get();
        return $persons;
      }


      public function searchDadBySurname(Request $request) {
        $surname = $request->input('surname');
        $persons = [];
  
        if (strlen($surname) == 0) {
          return $persons;
        }
  
        $persons = DB::table('person')
          ->join('tutor', 'tutor.id', '=', 'person.id')
          ->select('person.id',DB::raw('CONCAT(person.first_surname," ",person.second_surname," ",person.names," - ",IFNULL( tutor.dpi , "")) as text'))
          ->where('person.first_surname', 'like', $surname.'%')
          ->where('person.gender_id', 'like', '2')
          ->where('tutor.status', 'like', 'ACTIVO')
          ->get();
        return $persons;
      }

      
      public function searchMomBySurname(Request $request) {
        $surname = $request->input('surname');
        $persons = [];
  
        if (strlen($surname) == 0) {
          return $persons;
        }
  
        $persons = DB::table('person')
          ->join('tutor', 'tutor.id', '=', 'person.id')
          ->select('person.id',DB::raw('CONCAT(person.first_surname," ",person.second_surname," ",person.names," - ",IFNULL( tutor.dpi , "")) as text'))
          ->where('person.first_surname', 'like', $surname.'%')
          ->where('person.gender_id', 'like', '1')
          ->where('tutor.status', 'like', 'ACTIVO')
          ->get();
        return $persons;
      }


          
    public function status (Request $request) {
      $status = $request->input('status');
      $id = $request->input('id');

      $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';

      $course = DB::table('tutor')->where('id', $id)
      ->update(array(
          'status' => $status,
      ));

      return response()->json(
      [
          'data' => ['status' => $status]
      ]
      );
    }

    public function destroystudent($tutor_id,$student_id)
    {
        try{
            Studenttutor::where(['tutor_id' => $tutor_id, 'student_id'=> $student_id])->delete();
        }catch(\Exception $e){
            return redirect()->action('TutorController@edit',['id' => $tutor_id]) 
            ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
        }

        return redirect()->action('TutorController@edit',['id' => $tutor_id]) 
        ->with(['status' => 'Se elimino el registro.']);
        
    }

    public function destroy($id)
    {
      try{

        $tutor = \App\Tutor::where('id', $id)->first();

        \App\Studenttutor::where('tutor_id',$id)->delete();

        $tutor->delete();

        \App\Person::where('id',$id)->delete();
        
      }catch(\Exception $e){
        return redirect()->route('tutor.index')
        ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
      }

      return redirect()->route('tutor.index')
                      ->with(['status' => 'Se elimino el registro.']);
      

    }
}
