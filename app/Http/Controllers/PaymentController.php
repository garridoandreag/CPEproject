<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use App\Payment;


class PaymentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $payments = \App\Payment::sortable()->paginate(30);

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
            'code_reference' => ['required','unique:payment,code_reference,'],
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
        //
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
