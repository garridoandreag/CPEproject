<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }

    public function searchPersonWithName(Request $request)
    {
      $search = $request->input('name');
      $person = DB::table('person')
        ->select('id', 'first_surname', 'second_surname')
        ->where('first_surname', 'like', '%'.$search)
        ->get();

      return response()->json(['data' => $person]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Person $person)
    {
        //
    }

    public function edit(Person $person)
    {
        //
    }

    public function update(Request $request)
    {
        //


    }

    public function destroy(Person $person)
    {
        //
    }
}
