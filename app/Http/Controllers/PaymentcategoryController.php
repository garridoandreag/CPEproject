<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Paymentcategory; 

class PaymentcategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $paymentcategories = \App\Paymentcategory::sortable()->paginate(30);

        return view('paymentcategory.index', compact('paymentcategories'));
    }

    public function create()
    {
        return view('paymentcategory.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:250'],
            'payment_date' => ['required', 'date'],
            'amount' => ['required','numeric'],
            
        ]);

        Paymentcategory::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'payment_date' => $data['payment_date'],
            'amount' => $data['amount'],
        ]);
     
        return redirect()->route('paymentcategory.index')
                        ->with(['status' => 'Categoría de pago creada correctamente.']);
    }

    public function detail($id)
    {
        $paymentcategory = \App\Paymentcategory::where('id', $id)->first();

        return view('paymentcategory.detail', [
            'paymentcategory' => $paymentcategory
        ]);
    }

    public function edit($id)
    {
        $paymentcategory = \App\Paymentcategory::where('id', $id)->first();
        
        return view('paymentcategory.create', [
            'paymentcategory' => $paymentcategory
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $paymentcategory= Paymentcategory::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:250'],
            'payment_date' => ['required', 'date'],
            'amount' => ['required','numeric'],
            
        ]);
        
        $paymentcategory->name = $data['name'];
        $paymentcategory->description = $data['description'];
        $paymentcategory->payment_date = $data['payment_date'];
        $paymentcategory->amount = $data['amount'];
      
        $paymentcategory->update();
     
        return redirect()->route('paymentcategory.index')
                        ->with(['status' => 'Categoría de pago actualizada correctamente.']);
    }

    public function status (Request $request) {
        $status = $request->input('status');
        $id = $request->input('id');
    
        $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';
    
        $course = DB::table('paymentcategory')->where('id', $id)
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
            Paymentcategory::where('id', '=', $id)->delete();

        }catch(\Exception $e){
            return redirect()->route('paymentcategory.index')
            ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);

        }

        return redirect()->route('paymentcategory.index')
        ->with(['status' => 'Se elimino el registro.']);
    }
}
