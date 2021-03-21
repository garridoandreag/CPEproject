<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use App\{Payment,School,Cycle,PaymentCategory,StudentTutor,Student};


class PaymentController extends Controller
{  

    public function __construct() {
        $this->middleware('auth');


    }
    
    public function index()
    {
        if(Auth::user()->role_id == 4){
            $user = Auth::user();
            $id = $user->person_id;

            $payments = \App\Payment::where('tutor_id',$id)->sortable()->paginate(30);
        }else{
            $payments = \App\Payment::sortable()->paginate(30);
        }

        return view('payment.index', compact('payments'));
    }

    public function create() {
        return view('payment.create');
    }

    public function exist(Request $request){
        $code = $request->input('code_reference');
        $payments = DB::table('payment')
                    ->where('code_reference',$code)
                    ->count();
        $message = 'Sin verificar';

        if($payments > 0){
            $message = 'DUPLICADO: Existen '.$payments.' numeros de BOLETAS iguales.';
        }
        else{
            $message = 'No hay BOLETAS duplicadas.';
        }
    
        return response()->json(['mensaje' => $message]);
    }


    public function existreceipt(Request $request){
        $code = $request->input('receipt_number');
        $payments = DB::table('payment')
                    ->where('receipt_number',$code)
                    ->count();
        $message = 'Sin verificar';

        if($payments > 0){
            $message = 'DUPLICADO: Existen '.$payments.' numeros de RECIBOS iguales.';
        }
        else{
            $message = 'No hay RECIBOS duplicados.';
        }
    
        return response()->json(['mensaje' => $message]);
    }
 

    public function store(Request $request)
    {
  
        if ($request->has('repeated')) {

            $data = $request->validate([
                'paymentcategory_id' => ['required'],
                'cycle_id' => ['required'],
                'amount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                'repeated' => ['nullable'],
                'code_reference' => ['required'],
                'receipt_number' => ['required'],
                'student_id' => ['required'],
                'tutor_id' => ['required'],
            ]);

            
            
            Payment::create([
                'paymentcategory_id' => $data['paymentcategory_id'],
                'cycle_id' => $data['cycle_id'],
                'amount' => $data['amount'],
                'repeated' => 1,
                'code_reference' => $data['code_reference'],
                'receipt_number' => $data['receipt_number'],
                'student_id' => $data['student_id'],
                'tutor_id' => $data['tutor_id'],
            ]);
           
           
        }else{
            
            $data = $request->validate([
                'paymentcategory_id' => ['required'],
                'cycle_id' => ['required'],
                'amount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                'repeated' => ['nullable'],
                'code_reference' => ['required','unique:payment,code_reference'],
                'receipt_number' => ['required'],
                'student_id' => ['required'],
                'tutor_id' => ['required'],
            ]);

            Payment::create([
                'paymentcategory_id' => $data['paymentcategory_id'],
                'cycle_id' => $data['cycle_id'],
                'amount' => $data['amount'],
                'repeated' => 0,
                'code_reference' => $data['code_reference'],
                'receipt_number' => $data['receipt_number'],
                'student_id' => $data['student_id'],
                'tutor_id' => $data['tutor_id'],
            ]);
           
        };


    
        return redirect()->route('payment.index')
                        ->with(['status' => 'Pago registrado correctamente.']);
    }

    public function detail($id)
    {
        $payment = \App\Payment::where('id', $id)->first();

        return view('payment.detail', [
            'payment' => $payment
        ]);
    }

    public function edit($id)
    {
        $payment = \App\Payment::where('id', $id)->first();

        return view('payment.create', [
            'payment' => $payment
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $payment = \App\Payment::where('id', $id)->first();

        if ($request->has('repeated')) {

            $data = $request->validate([
                'paymentcategory_id' => ['required'],
                'cycle_id' => ['required'],
                'amount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                'repeated' => ['nullable'],
                'code_reference' => ['required'],
                'receipt_number' => ['required'],
                'student_id' => ['required'],
                'tutor_id' => ['required'],
            ]);
           
        }else{
            
            $data = $request->validate([
                'paymentcategory_id' => ['required'],
                'cycle_id' => ['required'],
                'amount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
                'repeated' => ['nullable'],
                'code_reference' => ['required','unique:payment,code_reference,'.$id],
                'receipt_number' => ['required'],
                'student_id' => ['required'],
                'tutor_id' => ['required'],
            ]);
           
        };


        $payment->paymentcategory_id =  $data['paymentcategory_id'];
        $payment->cycle_id =  $data['cycle_id'];
        $payment->amount =  $data['amount'];
        if ($request->has('repeated')) {
            $payment->repeated = 1;
        };
        $payment->code_reference =  $data['code_reference'];
        $payment->receipt_number =  $data['receipt_number'];
        $payment->student_id =  $data['student_id'];
        $payment->tutor_id =  $data['tutor_id'];

        $payment->update();

        return redirect()->action('PaymentController@index')->with('status', 'Pago actualizado correctamente');
        
    }

    public function getDishonor($cycle_id = ''){

        if(isset($cycle_id)){
            $nopayments = DB::select("select s.id, s.student_code, p.names, p.first_surname, p.second_surname
            from student s 
            inner join person p on s.id=p.id
            where s.id not in 
            (select student_id from payment pay
            inner join paymentcategory pc on pc.id=pay.paymentcategory_id
            where pay.cycle_id like 3
            and pc.id like ?
            and Date_format(PC.PAYMENT_DATE,'%d/%M') <= Date_format(now(),'%d/%M')
            )",  [1] );

        }

        return $nopayments;
    }

    public function menureport() {
        return view('payment.menureport');
    }



    
    public function reportpaymentallpdf(Request $request){

        try{
         $now = Carbon::now();
         $cycle_id = $request->input('cycle_id');
         $category_id= $request->input('paymentcategory_id');
         
         $school = School::find(1);
         $cycle = Cycle::find($cycle_id);
         $category = PaymentCategory::find($category_id);
 
         $reports = DB::table('person')
         ->join('student','person.id','student.id')
         ->join('subjectstudent', function ($join) use($cycle_id) {
             $join->on('person.id', '=', 'subjectstudent.student_id')
                  ->where('subjectstudent.cycle_id', '=', $cycle_id);
         })
         ->join('grade','subjectstudent.grade_id','grade.id')
         ->select('student.id','person.names', 'person.first_surname', 'person.second_surname','grade.name','student.student_code')
         ->whereNotIn('person.id', function ($query) use($cycle_id,$category_id ) {
             $query->select('student_id')
                   ->from('payment')
                   ->where([
                       ['cycle_id','=',$cycle_id],
                       ['paymentcategory_id','=',$category_id]
                       ]);
         })->groupBy('student.id','person.names', 'person.first_surname', 'person.second_surname','grade.name','student.student_code')
          ->havingRaw('max(subjectstudent.grade_id)')
         ->get();
     
         $tutors =  DB::table('datatutor')->get();
 
         $pdf = \PDF::loadView('/report/reportpaymentxcategorypdf',compact('reports','school','cycle','category','now','tutors'));
         }catch(\Exception $e){
             return redirect()->action('PaymentController@index') 
             ->with(['warning' => 'No hay datos']);
         }
         
         return $pdf->download('ReporteFaltaPagoCategoria.pdf');
     }

    public function reportpaymentxcategorypdf(Request $request){

       try{
        $now = Carbon::now();
        $cycle_id = $request->input('cycle_id');
        $category_id= $request->input('paymentcategory_id');
        
        $school = School::find(1);
        $cycle = Cycle::find($cycle_id);
        $category = PaymentCategory::find($category_id);

        $reports = DB::table('person')
        ->join('student','person.id','student.id')
        ->join('subjectstudent', function ($join) use($cycle_id) {
            $join->on('person.id', '=', 'subjectstudent.student_id')
                 ->where('subjectstudent.cycle_id', '=', $cycle_id);
        })
        ->join('grade','subjectstudent.grade_id','grade.id')
        ->select('student.id','person.names', 'person.first_surname', 'person.second_surname','grade.name','student.student_code')
        ->whereNotIn('person.id', function ($query) use($cycle_id,$category_id ) {
            $query->select('student_id')
                  ->from('payment')
                  ->where([
                      ['cycle_id','=',$cycle_id],
                      ['paymentcategory_id','=',$category_id]
                      ]);
        })->groupBy('student.id','person.names', 'person.first_surname', 'person.second_surname','grade.name','student.student_code')
         ->havingRaw('max(subjectstudent.grade_id)')
        ->get();
    
        $tutors =  DB::table('datatutor')->get();

        $pdf = \PDF::loadView('/report/reportpaymentxcategorypdf',compact('reports','school','cycle','category','now','tutors'));
        }catch(\Exception $e){
            return redirect()->action('PaymentController@index') 
            ->with(['warning' => 'No hay datos']);
        }
        
        return $pdf->download('ReporteFaltaPagoCategoria.pdf');
    }

    
    public function reportpaymentstudentpdf(Request $request){

       try{
         $now = Carbon::now();
         $cycle_id = $request->input('cycle_id');
         $student_id= $request->input('student_id');
         
         $school = School::find(1);
         $cycle = Cycle::find($cycle_id);
         $student = Student::find($student_id);
 
         $reports = DB::table('paymentcategory')
                    ->select('name')
                    ->selectRaw('IF((SELECT pay.paymentcategory_id 
                    FROM payment pay 
                    WHERE pay.student_id LIKE ? 
                    AND paymentcategory.id=pay.paymentcategory_id
                    AND pay.cycle_id=?),"CANCELADO","PENDIENTE") as estado',[$student_id,$cycle_id])
                    ->get();
     
 
         $pdf = \PDF::loadView('/report/reportpaymentstudentpdf',compact('reports','school','cycle','student','now'));
       }catch(\Exception $e){
            return redirect()->action('PaymentController@index') 
           ->with(['warning' => 'No hay datos']);
       }
         
         return $pdf->download('Reporte.pdf');
     }

    public function destroy($id)
    {
        try{
            Payment::where('id', '=', $id)->delete();
        }catch(\Exception $e){
            return redirect()->route('payment.index')
            ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
        }

        return redirect()->route('payment.index')
        ->with(['status' => 'Se elimino el registro.']);
    }
}
