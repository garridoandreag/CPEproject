<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\{Student, Person, Caregiver, Liststudent, Studenttutor};

class StudentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $students = \App\Student::sortable()->paginate(15);

        return view('student.index', compact('students'));
    }

    public function create() {
        return view('student.create');
    }

    public function store(Request $request) {

        $caregivers = '';
        $name_caregivers = $request->input('name_caregiver');
        $surname_caregivers = $request->input('surname_caregiver');
        $relationship = $request->input('relationship');
        $phone_number = $request->input('phone_number_caregiver');

        $data = $request->validate([
            'favorite_name' => ['nullable', 'string', 'max:50'],
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => ['required'],
            'home_address' => ['nullable', 'string', 'max:250'],
            'student_code' => ['nullable', 'string', 'max:15','unique:student,student_code,'],
            'birthday' => ['nullable'],
            'picture' => ['nullable'],
            'name_caregiver' => ['nullable'],
            'surname_caregiver' =>  ['nullable'],
            'relationship' =>  ['nullable'],
            'phone_number_caregiver' =>  ['nullable','max:8'],
            'dad_id' =>  ['nullable'],
            'mom_id' =>  ['nullable'],
        ]);

        $picture = $request->file('picture');
        $picture_name = 'student.png';


        if ($picture) {
            $picture_name = time() . $picture->getClientOriginalName();//colocarle un nombre unico
            Storage::disk('users')->put($picture_name, File::get($picture));//guardar en la carpeta storage (storage/app/users)
        }

        DB::transaction(function() use ($data,$picture_name,$caregivers,$name_caregivers, $surname_caregivers,$relationship,$phone_number) {
            $person = Person::create([
                'favorite_name' => $data['favorite_name'],
                'names' => $data['names'],
                'first_surname' => $data['first_surname'],
                'second_surname' => $data['second_surname'],
                'phone_number' => $data['phone_number'],
                'country_code' => '320',
                'subdivision_code' => $data['subdivision_code'],
                'home_address' => $data['home_address'],
                'picture' => $picture_name,
                'gender_id' => $data['gender_id'],
                'student' => '1',
            ]);

            $student = $person->student()->create([
                'student_code' => $data['student_code'],
                'birthday' => $data['birthday']
            ]);

            if (isset($data['dad_id'])) {
                Studenttutor::updateOrCreate(
                    ['student_id' =>  $person->id, 'no_tutor' => '1'],
                    ['tutor_id' => $data['dad_id'], 'relationship' => 'Padre']
                );
            }
    
            if (isset($data['mom_id'])) {
                Studenttutor::updateOrCreate(
                    ['student_id' =>  $person->id, 'no_tutor' => '2'],
                    ['tutor_id' => $data['mom_id'], 'relationship' => 'Madre']
                );              
            }
    
            if ($name_caregivers[0] != '' ) {
                $caregivers = sizeof($request->input('name_caregiver'));

            for($i = 0; $i < $caregivers; $i++){
                Caregiver::create([
                    'student_id' => $person->id,
                    'name' => $name_caregivers[$i],
                    'surname'  => $surname_caregivers[$i],
                    'relationship' => $relationship[$i],
                    'phone_number' => $phone_number[$i]
                ]);
            }
        }
    });
      return redirect()->route('student.index')
                        ->with(['status' => 'Estudiante creado correctamente']);
    }

    public function getImage($filename) {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id) {
        $student = \App\Student::where('id', $id)->first();
  

        $dadstudent = DB::table('tutor')
        //->select('studenttutor.tutor_id as tutor_id', 'person.names as names','person.first_surname as first_surname','person.second_surname as second_surname')
        ->join('studenttutor', 'tutor.id', '=', 'studenttutor.tutor_id')
        ->join('person', 'tutor.id', '=', 'person.id')
        ->where('studenttutor.student_id',$id)
        ->where('person.gender_id','2')
        ->first();  


        $momstudent= DB::table('tutor')
       // ->select('studenttutor.tutor_id as tutor_id', 'person.names as names','person.first_surname as first_surname','person.second_surname as second_surname')
        ->join('studenttutor', 'tutor.id', '=', 'studenttutor.tutor_id')
        ->join('person', 'tutor.id', '=', 'person.id')
        ->where('studenttutor.student_id',$id)
        ->where('person.gender_id','1')
        ->first();  

        return view('student.detail', [
            'student' => $student,
            'dadstudent' => $dadstudent,
            'momstudent' => $momstudent,
        ]);

    }


    public function list($grade_id,$cycle_id = '') {

        $user = \Auth::user();
        
        $id = $user->person_id;
        $role_id = $user->role_id;


        try{
            if(isset($cycle_id) && is_object($cycle_id)){
                $liststudents = \App\Liststudent::where('liststudent.cycle_id','like',$cycle_id)
                ->where('cycle_id','like',$cycle_id)
                ->where('grade_id','like',$grade_id)
                ->select('id','student_code','names','first_surname','second_surname','cycle_id','cycle','grade_id','grade','picture')
                ->sortable()->paginate(15);

            }else{
                $liststudents = \App\Liststudent::where('liststudent.cycle_id','like',$cycle_id)
                ->where('grade_id','like',$grade_id)
                ->select('id','student_code','names','first_surname','second_surname','cycle_id','cycle','grade_id','grade','picture')
                ->sortable()->paginate(15);
            }
            
        }catch(\Exception $e){
            return view('student.list');
        }

        return view('student.list', compact('liststudents','grade_id'));
    }

    public function grade() {
        $user = \Auth::user();
        $role_id =  $user->role_id;
        
        if($role_id <= 2){
            $employeegrades = DB::table('grade')
            ->select('id')
            ->where('status', 'ACTIVO')
            ->get();
        }else {
            $employee_id = $user->person_id;

            $employeegrades = DB::table('grade')
                    ->select('id')
                    ->whereRaw('id = any (SELECT grade_id FROM coursegrade 
                                            WHERE employee_id like ?
                                            AND status like "ACTIVO")',$employee_id )
                    ->get();
        }


        return view('student.grade',compact('employeegrades'));
    }

    public function edit($id) {

        $student = \App\Student::where('id', $id)->first();


        $dadstudent = DB::table('tutor')
        //->select('studenttutor.tutor_id as tutor_id', 'person.names as names','person.first_surname as first_surname','person.second_surname as second_surname')
        ->join('studenttutor', 'tutor.id', '=', 'studenttutor.tutor_id')
        ->join('person', 'tutor.id', '=', 'person.id')
        ->where('studenttutor.student_id',$id)
        ->where('person.gender_id','2')
        ->first();  


        $momstudent= DB::table('tutor')
       // ->select('studenttutor.tutor_id as tutor_id', 'person.names as names','person.first_surname as first_surname','person.second_surname as second_surname')
        ->join('studenttutor', 'tutor.id', '=', 'studenttutor.tutor_id')
        ->join('person', 'tutor.id', '=', 'person.id')
        ->where('studenttutor.student_id',$id)
        ->where('person.gender_id','1')
        ->first();  

                return view('student.create', [
                    'student' => $student,
                    'dadstudent' => $dadstudent,
                    'momstudent' => $momstudent,
                ]);
    }

    public function searchStudentBySurname(Request $request) {
      $surname = $request->input('surname');
      $persons = [];

      if (strlen($surname) == 0) {
        return $persons;
      }

      $persons = DB::table('person')
        ->join('student', 'student.id', '=', 'person.id')
        ->select('person.id',DB::raw('CONCAT(person.first_surname," ",person.second_surname," ",person.names," - ", IFNULL( student.student_code , "") ) as text'))
        ->where('person.first_surname', 'like', $surname.'%')
        ->get();

      return $persons;
    }

    

    public function update(Request $request) {

        $id = $request->input('id');
        $person = Person::find($id);
        $student = Student::find($id);

        
        $name_caregivers = $request->input('name_caregiver');
        $surname_caregivers = $request->input('surname_caregiver');
        $relationship = $request->input('relationship');
        $phone_number = $request->input('phone_number_caregiver');

        $picture = $request->file('picture');

        $data = $request->validate([
            'favorite_name' => ['required', 'string', 'max:50'],
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => ['required'],
            'home_address' => ['required', 'string', 'max:250'],
            'student_code' => ['nullable', 'string', 'max:15'],
            'birthday' => ['required'],
            'picture' => ['nullable'],
            'name_caregiver' => ['nullable'],
            'surname_caregiver' =>  ['nullable'],
            'relationship' =>  ['nullable'],
            'phone_number_caregiver' => ['nullable','max:8'],
            'dad_id' =>  ['nullable'],
            'mom_id' =>  ['nullable'],
        ]);

        if ($picture) {

            $picture_name = time() . $picture->getClientOriginalName();//colocarle un nombre unico

            Storage::disk('users')->put($picture_name, File::get($picture));//guardar en la carpeta storage (storage/app/users)

            $person->picture = $picture_name;
        }

        $person->favorite_name =  $data['favorite_name'];
        $person->names =  $data['names'];
        $person->first_surname =  $data['first_surname'];
        $person->second_surname =  $data['second_surname'];
        $person->phone_number =  $data['phone_number'];
        $person->subdivision_code =  $data['subdivision_code'];
        $person->home_address =  $data['home_address'];
        $student->student_code =  $data['student_code'];
        $student->birthday =  $data['birthday'];

        $person->update();
        $student->update();
     
        if (isset($data['dad_id'])) {
            Studenttutor::updateOrCreate(
                ['student_id' =>  $person->id, 'no_tutor' => 1],
                ['tutor_id' => $data['dad_id'], 'relationship' => 'Padre']
            );
        }

        if (isset($data['mom_id'])) {
            Studenttutor::updateOrCreate(
                ['student_id' =>  $person->id, 'no_tutor' => 2],
                ['tutor_id' => $data['mom_id'], 'relationship' => 'Madre']
            );              
        }

        if ($name_caregivers[0] != '' ) {
            $caregivers = sizeof($request->input('name_caregiver'));

        for($i = 0; $i < $caregivers; $i++){
            Caregiver::updateOrCreate([
                'student_id' => $person->id,
                'name' => $name_caregivers[$i],
                'surname'  => $surname_caregivers[$i],
                'relationship' => $relationship[$i],
                'phone_number' => $phone_number[$i]
            ]);
        }
    }

        return redirect()->action('StudentController@index')->with('status', 'Estudiante actualizado correctamente');
    }

    public function status (Request $request) {
        $status = $request->input('status');
        $id = $request->input('id');

        $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';

    
        $student = DB::table('student')->where('id', $id)
          ->update(array(
            'status' => $status,
          ));

        return response()->json(
          [
            'data' => ['status' => $status]
          ]
        );
    }
    
  public function destroy($id){

    try{
      $student = \App\Student::where('id', $id)->first();

      \App\Caregiver::where('student_id',$id)->delete();

      \App\Studenttutor::where('student_id',$id)->delete();

      $student->delete();

      \App\Person::where('id',$id)->delete();

    }catch(\Exception $e){
        return redirect()->route('student.index')
        ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
    }

    return redirect()->route('student.index')
                    ->with(['status' => 'Se elimino el registro.']);
    }




}
