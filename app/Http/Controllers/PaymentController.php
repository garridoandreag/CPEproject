<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use App\{Payment,School,Cycle,PaymentCategory,Grade};


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

    public function store(Request $request)
    {
        $data = $request->validate([
            'paymentcategory_id' => ['required'],
            'cycle_id' => ['required'],
            'amount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
            'code_reference' => ['required','unique:payment,code_reference'],
            'student_id' => ['required'],
            'tutor_id' => ['required'],
        ]);

        Payment::create([
            'paymentcategory_id' => $data['paymentcategory_id'],
            'cycle_id' => $data['cycle_id'],
            'amount' => $data['amount'],
            'code_reference' => $data['code_reference'],
            'student_id' => $data['student_id'],
            'tutor_id' => $data['tutor_id'],
        ]);
    
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

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'paymentcategory_id' => ['required'],
            'cycle_id' => ['required'],
            'amount' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
            'code_reference' => ['required','unique:payment,code_reference'],
            'student_id' => ['required'],
            'tutor_id' => ['required'],
        ]);

        $payment->paymentcategory_id =  $data['paymentcategory_id'];
        $payment->cycle_id =  $data['cycle_id'];
        $payment->amount =  $data['amount'];
        $payment->code_reference =  $data['code_reference'];
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

    public function reportpaymentxcategorypdf(Request $request){

      // try{
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
        ->select('person.names', 'person.first_surname', 'person.second_surname','grade.name')
        ->whereNotIn('person.id', function ($query) use($cycle_id,$category_id ) {
            $query->select('student_id')
                  ->from('payment')
                  ->where([
                      ['cycle_id','=',$cycle_id],
                      ['paymentcategory_id','=',$category_id]
                      ]);
        })->groupBy('person.names', 'person.first_surname', 'person.second_surname','grade.name')
         ->havingRaw('max(subjectstudent.grade_id)')
        ->get();
    

        $pdf = \PDF::loadView('/report/reportpaymentxcategorypdf',compact('reports','school','cycle','category'));
     //   }catch(\Exception $e){
     //       return redirect()->action('PaymentController@index') 
      //      ->with(['warning' => 'No hay datos']);
      //  }
        
        return $pdf->download('ReporteFaltaPagoCategoria.pdf');
    }


    public function destroy($id)
    {
        //
    }
}
