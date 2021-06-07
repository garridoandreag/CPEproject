<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
         
class UserController extends Controller {

    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config() {
        return view('user.config');
    }

    public function update(Request $request) {
        try{
        
        $user = \Auth::user();
        
        $id = $user->id;
        
        //VALIDACION DEL FORMULARIO
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'regex:/^([a-zA-Z]){3}.([a-zA-Z]){3,}/', 'max:255', 'unique:users,email,' . $id], //PARA VALIDAR QUE EL EMAIL ES UNICO Y NO PERTENECE AL REGISTRO QUE SE ESTA ACTUALIZANDO
        ]);

        //RECOGER LOS DATOS DEL FORMULARIO
        $name = $request->input('name');
        $email = $request->input('email');

        //ASIGNAR VALORES AL OBJETO DEL USUARIO
        $user->name = $name;
        $user->email = $email;

        //subir imagen
        $picture = $request->file('picture');
        
        if($picture){
            
            //colocarle un nombre unico
            $picture_name= time().$picture->getClientOriginalName();
            
            
            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($picture_name,File::get($picture));
            
            
            //setear el nombre de la imagen en el objeto
            $user->person->picture= $picture_name;
            
            $user->person->save();

            $user->update();

        }
    }catch(\Exception $e){
        return redirect()->route('config')
                        ->with(['warning' => 'El usuario NO se pudo actualizar. Error:'.$e]);
    }

//ejecutar consulta y cambios en la base de datos
        return redirect()->route('config')
                        ->with(['message' => 'Usuario actualizado correctamente']);
    }
    
    public function  getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }

    public function index(){
        $users = User::orderBy('id','desc')->paginate(30);

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function detail($id)
    {
        $user = User::where('id', $id)->first();

        return view('user.detail', [
            'user' => $user
        ]);
   
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('auth.register', [
            'user' => $user
        ]);
    }

    public function updateToUser(Request $request) {
        
        try{
        $id = $request->input('id');
        $user = User::where('id', $id)->first();

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'regex:/^([a-zA-Z]){3}.([a-zA-Z]){3,}/', 'max:255', 'unique:users,email,' . $id], //PARA VALIDAR QUE EL EMAIL ES UNICO Y NO PERTENECE AL REGISTRO QUE SE ESTA ACTUALIZANDO
            'password' => ['nullable', 'string', 'min:4', 'confirmed'],
            ]);

        //RECOGER LOS DATOS DEL FORMULARIO
        $name = $request->input('name');
        $email = $request->input('email');
        $role_id = $request->input('role_id');
        $password = $request->input('password');

        //ASIGNAR VALORES AL OBJETO DEL USUARIO
        $user->name = $name;
        $user->email = $email;
        $user->role_id = $role_id;
        $user->password = Hash::make( $password );

        //ejecutar consulta y cambios en la base de datos
        $user->update();
    }catch(\Exception $e){
        return redirect()->action('UserController@index')->with('warning', 'El usuario no se pudo actualizar. Error '.$e);

    }
        return redirect()->action('UserController@index')->with('status', 'Usuario actualizado correctamente');
    }

    public function status (Request $request) {
        $status = $request->input('status');
        $id = $request->input('id');

        $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';

    
        $user = DB::table('users')->where('id', $id)
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
            User::where('id', '=', $id)->delete();

        }catch(\Exception $e){
            return redirect()->route('user.index')
            ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
        }

        return redirect()->route('user.index')
        ->with(['status' => 'Se elimino el registro.']);
    }

}
