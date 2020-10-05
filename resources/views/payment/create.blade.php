@extends('layouts.app')

@section('content')
  @inject('paymentcategories','App\Services\Paymentcategories')
  @inject('cycles','App\Services\Cycles')

  <style>
    .select-search {
      width: 100%;
    }

  </style>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
  <div class="container">
    <div class="row justify-content-center ">

      <div class="col-md-8">

        @if (session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif
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
                      @foreach ($cycles->get() as $index => $cycle)

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
                  <label for="code_reference" class="col-md-4 col-form-label text-md-right">Código de Referencia</label>
                  <div class="col-md-6">
                    <input id="code_reference" type="text" class="form-control @error('code_reference') is-invalid @enderror"
                      name="code_reference" value="{{ $payment->code_reference ?? '' }}" required autocomplete="code_reference" autofocus>

                    @error('code_reference')
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
                    <a href="{{ route('payment.index') }}" class="btn btn-outline-primary">Regresar </a>
                    <button type="submit" class="btn btn-primary">
                      @if (isset($payment) && is_object($payment))
                        Actualizar
                      @else
                        Guardar
                      @endif
                    </button>

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
              code: params.term,
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
              dpi: params.term,
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
</script>
@endsection
