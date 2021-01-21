<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Cycle, Coursegrade, Pensum}; 

class CycleController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $cycles = \App\Cycle::sortable()->paginate(30);

        return view('cycle.index', compact('cycles'));
    }

    public function create()
    {
        return view('cycle.create');
    }

    public function store(Request $request)
    {
        $pensums = Pensum::get();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'school_id' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            
        ]);

        DB::transaction(function() use ($data,$pensums){
            $cycle = Cycle::create([
                'name' => $data['name'],
                'school_id' => $data['school_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ]);
    
                foreach($pensums as $pensum){
                    Coursegrade::create([
                        'grade_id' => $pensum->grade_id,
                        'course_id' => $pensum->course_id,
                        'cycle_id' => $cycle->id,
                        'status' => $pensum->status
                    ]);
    
                }
        });

        return redirect()->route('cycle.index')
                        ->with(['status' => 'Ciclo creado correctamente.']);
    }

    public function detail($id)
    {
        $cycle = \App\Cycle::where('id', $id)->first();

        return view('cycle.detail', [
            'cycle' => $cycle
        ]);
    }

    public function edit($id)
    {
        $cycle = \App\Cycle::where('id', $id)->first();
        
        return view('cycle.create', [
            'cycle' => $cycle
        ]);
    }


    public function update(Request $request)
    {
        $id = $request->input('id');
        $cycle = Cycle::find($id);
        $pensums = Pensum::get();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'school_id' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
       
            $cycle->name =  $data['name'];
            $cycle->school_id =  $data['school_id'];
            $cycle->start_date = $data['start_date'];
            $cycle->end_date = $data['end_date'];

            foreach($pensums as $pensum){
                
                Coursegrade::firstOrCreate([
                    'grade_id' => $pensum->grade_id,
                    'course_id' => $pensum->course_id,
                    'cycle_id' => $cycle->id,
                    'status' => $pensum->status
                ]);

            }

            $cycle->update();

        return redirect()->route('cycle.index')
                        ->with(['status' => 'Ciclo actualizado correctamente.']);
    }

    public function status (Request $request) {
        $status = $request->input('status');
        $id = $request->input('id');
    
        $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';
    
        $cycle = DB::table('cycle')->where('id', $id)
          ->update(array(
            'status' => $status,
          ));
    
        return response()->json(
          [
            'data' => ['status' => $status]
          ]
        );
      }

    public function destroy($id)
    {
        //
    }
}
