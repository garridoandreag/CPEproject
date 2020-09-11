<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Coursegrade; 
use App\Activity; 

class ActivityController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $activities = \App\activity::sortable()->paginate(30);

        return view('activity.index', compact('activities'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'unit_id' => ['required'],
            'coursegrade_id' => ['required'],
            'name' => ['required', 'string','max:50'],
            'description' => ['required','string','max:900'],
            'score' => ['required'],
            'delivery_date' => ['require','date'],
        ]);

        Cycle::create([
            'unit_id' => $data['unit_id'],
            'coursegrade_id' => $data['coursegrade_id'],
            'name' => $data['name'],
            'description'=> $data['description'],
            'score' => $data['score'],
            'delivery_date'=> $data['delivery_date'],
        ]);
     
        return redirect()->route('cycle.index')
                        ->with(['status' => 'Ciclo creado correctamente.']);
    }

    public function courseprofessoractivity($coursegrade_id)
    {
        $activities=Activity::where('coursegrade_id', $coursegrade_id)
                                ->firstOrFail()->sortable()->paginate(30);

        return view('courseprofessor.activity', compact('activities','coursegrade_id'));
    }

    public function courseprofessoractivityunit($unit_id)
    {
        $activities=Activity::Where('unit_id',$unit_id)
                                ->firstOrFail()->orderby('unit_id')->sortable()->paginate(30);

                               // var_dump($activities);
                               // die();
            return view('courseprofessor.activityunit', compact('activities','coursegrade_id'));
    }

    public function edit($id)
    {
        //
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
