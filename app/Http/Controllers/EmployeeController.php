<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Employee; 

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
        //
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
