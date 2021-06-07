@extends('layouts.app')

@section('content')
  @inject('paymentcategories','App\Services\Paymentcategories')
  @inject('cycles','App\Services\Cycles')
  @inject('existPayment', 'App\Services\Payments')

  <style>
    .select-search {
      width: 100%;
    }

  </style>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
  <div class="container">
    <div class="row justify-content-center ">

      <div class="col-md-8">

        <div class="card-group">
          <div class="card">

            <div class="card-header">
              @if (isset($payment) && is_object($payment))
                Modificar pago
              @else
                Nuevo pago
              @endif
            </div>

            <div class="card-body">

              <form id="gradeForm" method="POST"
                action="{{ isset($payment) ? route('payment.update') : route('payment.store') }}"
                enctype="multipart/form-data" aria-label="pagos">
                {{ csrf_field() }}

                @if (isset($payment) && is_object($payment))
                  <input type="hidden" name="id" value="{{ $payment->id }}" /><br>
                @endif


                <div class="form-group row">
                  <label for="paymentcategory_id" class="col-md-4 col-form-label text-md-right">Categoría</label>
                  <div class="col-md-6">
                    <select id="paymentcategory_id" name="paymentcategory_id"
                      class="form-control  @error('paymentcategory_id') is-invalid @enderror">
                      @foreach ($paymentcategories->get() as $index => $paymentcategory)

                      <option value="{{ $index }}"
                      {{ old('paymentcategory_id', $payment->paymentcategory_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $paymentcategory }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cycle_id" class="col-md-4 col-form-label text-md-right">Ciclo</label>
                  <div class="col-md-6">
                    <select id="cycle_id" name="cycle_id" class="form-control  @error('cycle_id') is-invalid @enderror">
                      @foreach ($cycles->getAll() as $index => $cycle)

                        <option value="{{ $index }}"
                          {{ old('cycle_id', $payment->cycle_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $cycle }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>


                <div class="form-group row">
                  <label for="amount" class="col-md-4 col-form-label text-md-right">Monto</label>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Q.</span>
                      </div>
                      <input id="amount" type="number" step="any"
                        class="form-control @error('amount') is-invalid @enderror" name="amount"
                        value="{{ $payment->amount ?? '' }}" required autocomplete="amount" autofocus>
                    </div>
                    @error('amount')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="code_reference" class="col-md-4 col-form-label text-md-right">No. de Boleta</label>
                  <div class="col-md-6">
                    <input id="code_reference" type="text"
                      class="form-control @error('code_reference') is-invalid @enderror" name="code_reference"
                      value="{{ $payment->code_reference ?? '' }}" required autocomplete="code_reference" autofocus>
                    <center>
                      <div class="alert" id="divmsg" style="display:none" role="alert">
                      </div>
                    </center>
                    @error('code_reference')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>


                <div class="form-group row">
                  <label for="repeated-space" class="col-md-4 col-form-label text-md-right"></label>
                  <div class="col-md-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="repeated" id="repeated" value="1"
                        {{ $payment->repeated ?? '' || old('repeated', 0) === 1 ? 'checked' : 'unchecked' }}>
                      <label class="form-check-label" for="repeated">
                        Aceptar repetidos
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="receipt_number" class="col-md-4 col-form-label text-md-right">No. de Recibo</label>
                  <div class="col-md-6">
                    <input id="receipt_number" type="text"
                      class="form-control @error('receipt_number') is-invalid @enderror" name="receipt_number"
                      value="{{ $payment->receipt_number ?? '' }}" required autocomplete="receipt_number" autofocus>
                    <center>
                      <div class="alert" id="divmsg2" style="display:none" role="alert">
                      </div>
                    </center>
                    @error('receipt_number')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>





                <div class="form-group row">
                  <label for="student_id" class="col-md-4 col-form-label text-md-right">Estudiante</label>
                  <div class="col-md-6">
                    <select name="student_id" class="select-search" id="select">
                      <option value="{{ $payment->student_id ?? '' }}" {{ old('student_id') ? 'selected' : '' }}>
                        {{ $payment->student->person->names ?? '' }}
                        {{ $payment->student->person->first_surname ?? '' }}
                        {{ $payment->student->person->second_surname ?? '' }}
                      </option>
                    </select>

                    @error('student_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tutor_id" class="col-md-4 col-form-label text-md-right">Padre (Encargado) </label>
                  <div class="col-md-6">
                    <select name="tutor_id" class="select-search" id="select-tutor">
                      <option value="{{ $payment->tutor_id ?? '' }}" {{ old('tutor_id') ? 'selected' : '' }}>
                        {{ $payment->tutor->person->names ?? '' }}
                        {{ $payment->tutor->person->first_surname ?? '' }}
                        {{ $payment->tutor->person->second_surname ?? '' }}
                      </option>
                    </select>

                    @error('tutor_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>


                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary">Cancelar </a>
                    <button type="submit" class="btn btn-primary" id="registro">
                      @if (isset($payment) && is_object($payment))
                        Actualizar
                      @else
                        Guardar
                      @endif
                    </button>
                    @if (isset($payment) && is_object($payment))
                      <a href="{{ action('PaymentController@destroy', ['id' => $payment->id], ['method' => 'DELETE']) }}"
                        class="btn btn-danger">Eliminar</a>
                    @endif

                  </div>
                </div>
                <br />
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script>
    $(document).ready(function() {
      const select = $('#select');
      select.select2({
        ajax: {
          type: 'POST',
          url: '/student/search-student',
          data: function(params) {
            return {
              surname: params.term,
            };
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          processResults: function(data) {
            return {
              results: data
            };
          }
        }
      });
    });

    $(document).ready(function() {
      const select = $('#select-tutor');
      select.select2({

        ajax: {
          type: 'POST',
          url: '/tutor/search-tutor',
          data: function(params) {
            return {
              surname: params.term,
            };
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          processResults: function(data) {
            return {
              results: data
            };
          }
        }
      });
    });


    $(document).ready(function() {

      function mostrarMensaje(mensaje) {
        $("#divmsg").empty();
        if(mensaje.includes("No hay")){
          $("#divmsg").addClass("alert-success");
        }else{
          $("#divmsg").addClass("alert-danger");
        }
        $("#divmsg").append("<p>" + mensaje + "</p>");
        $("#divmsg").show(500);
        $("#divmsg").hide(5000);
      }

      $('#code_reference').blur(function(e) {
        e.preventDefault();

        var code_reference = $("input[name=code_reference]").val();
        $.ajax({
          type: "POST",
          url: "/payment/exist",
          data: {
            code_reference: code_reference
          },
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            mostrarMensaje(data.mensaje);
          }
        });
      });
    });


    $(document).ready(function() {

      function mostrarMensaje(mensaje) {
        $("#divmsg2").empty();
        if(mensaje.includes("No hay")){
          $("#divmsg2").addClass("alert-success");
        }else{
          $("#divmsg2").addClass("alert-danger");
        }
        $("#divmsg2").append("<p>" + mensaje + "</p>");
        $("#divmsg2").show(500);
        $("#divmsg2").hide(5000);
      }

      $('#receipt_number').blur(function(e) {
        e.preventDefault();

        var receipt_number = $("input[name=receipt_number]").val();
        $.ajax({
          type: "POST",
          url: "/payment/existreceipt",
          data: {
            receipt_number: receipt_number
          },
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            mostrarMensaje(data.mensaje);
            
          }
        });
      });
    });

  </script>
@endsection
