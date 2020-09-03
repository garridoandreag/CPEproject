<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
         
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
        $user = \Auth::user();
        
        $id = $user->id;
        
        //VALIDACION DEL FORMULARIO
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id], //PARA VALIDAR QUE EL EMAIL ES UNICO Y NO PERTENECE AL REGISTRO QUE SE ESTA ACTUALIZANDO
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

           

        }


//ejecutar consulta y cambios en la base de datos
        $user->update();
        return redirect()->route('config')
                        ->with(['message' => 'Usuario actualizado correctamente']);
//
//        var_dump($id);
//        var_dump($name);
        

    }
    
    public function  getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }

}
