<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Input;
use App\Employee;
use App\Person;  

class EmployeeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = \App\Employee::sortable()->paginate(30);

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:8'],
            'cellphone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => ['required'],
            'home_address' => ['required', 'string', 'max:250'],
            'dpi' => ['required', 'max:14'],
            'job_id' => ['required'],
            'professor' => ['required'],
            'salary' => ['nullable']
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
                'employee' => 1,
            ]);
    
            $person->employee()->create([
                'dpi' => $data['dpi'],
                'job_id' => $data['job_id'],
                'salary' => $data['salary'],
                'professor' => $data['professor'],
            ]);

        });

        return redirect()->route('employee.index')
                         ->with(['status' => 'Empleado creado correctamente.']);

    }

    public function detail($id)
    {
        $employee= \App\Employee::where('id', $id)->first();

        return view('employee.detail', [
            'employee' => $employee
        ]);
    }

    public function edit($id)
    {
        $employee = \App\Employee::where('id', $id)->first();
        
        return view('employee.create', [
            'employee' => $employee
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $employee = Employee::find($id);
        $person= Person::find($id);

        $data = $request->validate([
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:8'],
            'cellphone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => ['required'],
            'home_address' => ['required', 'string', 'max:250'],
            'dpi' => ['required', 'string', 'max:13'],
            'job_id' => ['required'],
            'professor' => ['nullable'],
            'salary' => ['nullable','numeric'],
            'status' => ['nullable'],
        ]);

        $employee->person->names =  $data['names'];
        $employee->person->first_surname =  $data['first_surname'];
        $employee->person->second_surname =  $data['second_surname'];
        $employee->person->phone_number =  $data['phone_number'];
        $employee->person->cellphone_number =  $data['cellphone_number'];
        $employee->person->subdivision_code =  $data['subdivision_code'];
        $employee->person->gender_id =  $data['gender_id'];
        $employee->person->home_address =  $data['home_address'];
        $employee->dpi =  $data['dpi'];
        $employee->job_id =  $data['job_id'];
        $employee->professor=  $data['professor'];
        $employee->salary =  $data['salary'];
        $employee->status =  $data['status'];
        $employee->person->employee =  1;
        $employee->person->status =  $data['status'];

        $employee->save();
        $employee->person->save();

    return redirect()->route('employee.index')
                    ->with(['status' => 'Empleado actualizado correctamente.']);


    }

    public function destroy($id)
    {
        //
    }
}
