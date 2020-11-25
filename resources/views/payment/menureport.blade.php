@extends('layouts.app')

@section('content')
  @inject('paymentcategories','App\Services\Paymentcategories')
  @inject('cycles','App\Services\Cycles')
  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

  </script>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Reportes para el Control de Pagos</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a class="btn btn-outline-primary" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                @if (Auth::user()->role_id == 1)
                  <a href="{{ action('PaymentController@create') }}" class="btn btn-primary">Nuevo </a>
                @endif
              </div>
              <div class="col-md-auto">
                <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
              </div>
            </div>
            <br>

            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Reporte</th>
                  <th scope="col" colspan="2">Parametros</th>
                  <th scope="col">Descargar</th>
                </tr>
              </thead>
              <tbody id="myTable">
                <tr>
                  <td scope="row">
                    Falta de Pago General
                  </td>
                  <td colspan="2">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text"> Ciclo </span>
                      </div>
                      <select id="cycle_id" name="cycle_id" class="form-control  @error('cycle_id') is-invalid @enderror">
                        @foreach ($cycles->get() as $index => $cycle)
                          <option value="{{ $index }}"
                            {{ old('cycle_id', $payment->cycle_id ?? '') == $index ? 'selected' : '' }}>
                            {{ $cycle }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <form id="gradeForm" method="POST" action="{{ route('reportpaymentxcategorypdf') }}" enctype="multipart/form-data">
                    <td scope="row">
                      Falta de Pago por Categoría
                    </td>
                    <td scope="row">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> Ciclo </span>
                        </div>
                        <select id="cycle_id" name="cycle_id"
                          class="form-control  @error('cycle_id') is-invalid @enderror">
                          @foreach ($cycles->get() as $index2 => $cycle)
                            <option value="{{ $index2 }}"
                              {{ old('cycle_id', $payment->cycle_id ?? '') == $index2 ? 'selected' : '' }}>
                              {{ $cycle }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                    <td scope="row">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> Categoría </span>
                        </div>
                        <select id="paymentcategory_id" name="paymentcategory_id"
                          class="form-control  @error('paymentcategory_id') is-invalid @enderror">
                          @foreach ($paymentcategories->get() as $index3 => $paymentcategory)

                            <option value="{{ $index3 }}"
                              {{ old('paymentcategory_id', $payment->paymentcategory_id ?? '') == $index3 ? 'selected' : '' }}>
                              {{ $paymentcategory }}
                            </option>

                          @endforeach
                        </select>
                      </div>
                    </td>
                    <td scope="row">
                      <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                            Descargar
                          </button>
      
                        </div>
                      </div>
                    </td>
                  </form>
                </tr>
              </tbody>
            </table>
            <br>

          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
