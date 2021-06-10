<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Announcement; 

class AnnouncementController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $announcements = \App\Announcement::sortable()->paginate(30);

        return view('announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcement.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:900'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'cycle_id' => ['required'],
            
        ]);

        Announcement::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'cycle_id' =>  $data['cycle_id'],
        ]);
     
        return redirect()->route('announcement.index')
                        ->with(['status' => 'Aviso creado correctamente.']);
    }

    public function detail($id)
    {
        $announcement = \App\Announcement::where('id', $id)->first();

        return view('announcement.detail', [
            'announcement' => $announcement
        ]);
    }

    public function edit($id)
    {
        $announcement = \App\Announcement::where('id', $id)->first();
        
        return view('announcement.create', [
            'announcement' => $announcement
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $announcement = Announcement::find($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:900'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'cycle_id' => ['required'],
            
        ]);

        $announcement->title = $data['title'];
        $announcement->description = $data['description'];
        $announcement->start_time= $data['start_time'];
        $announcement->end_time = $data['end_time'];
        $announcement->cycle_id = $data['cycle_id'];

        $announcement->update();

    return redirect()->route('announcement.index')
                    ->with(['status' => 'Aviso actualizado correctamente.']);
    }

    
  public function status (Request $request) {
    $status = $request->input('status');
    $id = $request->input('id');

    $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';

    $course = DB::table('announcement')->where('id', $id)
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
        try{

            $announcement = Announcement::where('id',$id)->first();

            DB::transaction( function() use($announcement){
                $announcement->delete();
            });

        }catch(\Exception $e){

            return redirect()->route('announcement.index')
            ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
        }

        return redirect()->route('announcement.index')
        ->with(['status' => 'Se elimino el registro.']);

    }
}
