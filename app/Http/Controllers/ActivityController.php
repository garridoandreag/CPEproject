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
        //
    }

    public function courseprofessoractivity($coursegrade_id)
    {
        $coursegrade = $coursegrade_id;
        $activities=Activity::where('coursegrade_id', $coursegrade_id)
                                ->firstOrFail()->sortable()->paginate(30);

        return view('courseprofessor.activity', compact('activities'));
    }

    public function courseprofessoractivityunit($coursegrade_id, $unit_id)
    {
        $activities=Activity::where('coursegrade_id', $coursegrade_id)->where('unit_id',$unit_id)
                                ->firstOrFail()->sortable()->paginate(30);

        return view('courseprofessor.activity', compact('activities'));
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
