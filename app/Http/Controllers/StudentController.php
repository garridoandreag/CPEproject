<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\{Student, Person, Caregiver};

class StudentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $students = \App\Student::sortable()->paginate(2);

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
            'student_code' => ['required', 'string', 'max:15'],
            'birthday' => ['required'],
            'picture' => ['nullable'],
            'grade_id' => ['nullable'],
            'name_caregiver' => ['nullable'],
            'surname_caregiver' =>  ['nullable'],
            'relationship' =>  ['nullable'],
            'phone_number_caregiver' =>  ['nullable'],
        ]);

        $picture = $request->file('picture');
        $picture_name = 'student.png';

        if ($picture) {
            $picture_name = time() . $picture->getClientOriginalName();//colocarle un nombre unico
            Storage::disk('users')->put($picture_name, File::get($picture));//guardar en la carpeta storage (storage/app/users)
        }

        DB::transaction(function() use ($data,$picture_name,$caregivers,$name_caregivers, $surname_caregivers,$relationship,$phone_number) {
            $person = Person::create([
                'favorite_name' => strtoupper($data['favorite_name']),
                'names' => strtoupper($data['names']),
                'first_surname' => strtoupper($data['first_surname']),
                'second_surname' => strtoupper($data['second_surname']),
                'phone_number' => $data['phone_number'],
                'country_code' => '320',
                'subdivision_code' => $data['subdivision_code'],
                'home_address' => strtoupper($data['home_address']),
                'picture' => $picture_name,
                'gender_id' => $data['gender_id'],
                'student' => '1'
            ]);

            $student = $person->student()->create([
                'student_code' => $data['student_code'],
                'grade_id'  => $data['grade_id'],
                'birthday' => $data['birthday']
            ]);

            for($i = 0; $i < $caregivers; $i++){
                Caregiver::create([
                    'student_id' => $person->id,
                    'name' => strtoupper($name_caregivers[$i]),
                    'surname'  => strtoupper($surname_caregivers[$i]),
                    'relationship' => strtoupper($relationship[$i]),
                    'phone_number' => strtoupper($phone_number[$i])
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

    public function edit($id) {

        $student = \App\Student::where('id', $id)->first();

                return view('student.create', [
                    'student' => $student
                ]);
    }

    public function searchStudentByCode(Request $request) {
      $code = $request->input('code');
      $persons = [];

      if (strlen($code) == 0) {
        return $persons;
      }

      $persons = DB::table('person')
        ->join('student', 'student.id', '=', 'person.id')
        ->select('person.id',DB::raw('CONCAT(student.student_code," - ", person.first_surname," ",person.names) as text'))
        ->where('student.student_code', 'like', $code.'%')
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
            'name_caregiver' => ['nullable', 'string', 'max:50'],
            'surname_caregiver' =>  ['nullable', 'string', 'max:50'],
            'relationship' =>  ['nullable', 'string', 'max:50'],
            'phone_number_caregiver' =>  ['nullable', 'string', 'max:8'],
        ]);

        if ($picture) {

            $picture_name = time() . $picture->getClientOriginalName();//colocarle un nombre unico

            Storage::disk('users')->put($picture_name, File::get($picture));//guardar en la carpeta storage (storage/app/users)

            $person->picture = $picture_name;
        }

        $person->favorite_name =  strtoupper($data['favorite_name']);
        $person->names =  strtoupper($data['names']);
        $person->first_surname =  strtoupper($data['first_surname']);
        $person->second_surname =  strtoupper($data['second_surname']);
        $person->phone_number =  $data['phone_number'];
        $person->subdivision_code =  $data['subdivision_code'];
        $person->home_address =  strtoupper($data['home_address']);
        $student->student_code =  $data['student_code'];
        $student->birthday =  $data['birthday'];
        $student->grade_id =  $data['grade_id'];

        $person->update();
        $student->update();

        for($i = 0; $i < $caregivers; $i++){
            Caregiver::updateOrCreate([
                'student_id' => $person->id,
                'name' => strtoupper($name_caregivers[$i]),
                'surname'  => strtoupper($surname_caregivers[$i]),
                'relationship' => strtoupper($relationship[$i]),
                'phone_number' => $phone_number[$i]
            ]);
        }

        return redirect()->action('StudentController@index')->with('status', 'Estudiante actualizado correctamente');
    }



}
