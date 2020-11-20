<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\{Student, Person, Caregiver, Liststudent};

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

        $caregivers = sizeof($request->input('name_caregiver'));
        $name_caregivers = $request->input('name_caregiver');
        $surname_caregivers = $request->input('surname_caregiver');
        $relationship = $request->input('relationship');
        $phone_number = $request->input('phone_number_caregiver');

        $data = $request->validate([
            'favorite_name' => ['required', 'string', 'max:50'],
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => ['required'],
            'home_address' => ['required', 'string', 'max:250'],
            'student_code' => ['required', 'string', 'max:15','unique:student,student_code,'],
            'birthday' => ['required'],
            'picture' => ['nullable'],
            'grade_id' => ['nullable'],
            'name_caregiver' => ['nullable'],
            'surname_caregiver' =>  ['nullable'],
            'relationship' =>  ['nullable'],
            'phone_number_caregiver' =>  ['nullable','max:8'],
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
                'grade_id'  => $data['grade_id'],
                'birthday' => $data['birthday']
            ]);

            for($i = 0; $i < $caregivers; $i++){
                Caregiver::create([
                    'student_id' => $person->id,
                    'name' => $name_caregivers[$i],
                    'surname'  => $surname_caregivers[$i],
                    'relationship' => $relationship[$i],
                    'phone_number' => $phone_number[$i]
                ]);
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

        return view('student.detail', [
            'student' => $student
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

        return view('student.grade');
    }

    public function edit($id) {

        $student = \App\Student::where('id', $id)->first();

                return view('student.create', [
                    'student' => $student
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
        ->select('person.id',DB::raw('CONCAT(person.first_surname," ",person.second_surname," ",person.names," - ", student.student_code) as text'))
        ->where('person.first_surname', 'like', $surname.'%')
        ->get();
      return $persons;
    }

    public function update(Request $request) {

        $id = $request->input('id');
        $person = Person::find($id);
        $student = Student::find($id);

        $caregivers = sizeof($request->input('name_caregiver'));
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
            'phone_number' => ['required', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => ['required'],
            'home_address' => ['required', 'string', 'max:250'],
            'student_code' => ['required', 'string', 'max:15'],
            'birthday' => ['required'],
            'picture' => ['nullable'],
            'grade_id' => ['nullable'],
            'name_caregiver' => ['nullable'],
            'surname_caregiver' =>  ['nullable'],
            'relationship' =>  ['nullable'],
            'phone_number_caregiver' => ['nullable','max:8'],
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
        $student->grade_id =  $data['grade_id'];

        $person->update();
        $student->update();

        for($i = 0; $i < $caregivers; $i++){
            Caregiver::updateOrCreate([
                'student_id' => $person->id,
                'name' => $name_caregivers[$i],
                'surname'  => $surname_caregivers[$i],
                'relationship' => $relationship[$i],
                'phone_number' => $phone_number[$i]
            ]);
        }

        return redirect()->action('StudentController@index')->with('status', 'Estudiante actualizado correctamente');
    }



}
