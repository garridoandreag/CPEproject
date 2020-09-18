@extends('layouts.app')

@section('content')
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

  <style>
    .status {
      cursor: pointer;
    }

  </style>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Control de Pagos</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('PaymentController@create') }}" class="btn btn-primary">Nuevo </a>
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
                  <th scope="col">@sortablelink('paymentcategory_id','Categoría')</th>
                  <th scope="col">@sortablelink('cycle_id','Ciclo')</th>
                  <th scope="col">@sortablelink('code_reference','Referencia')</th>
                  <th scope="col">@sortablelink('student_id','Estudiante')</th>
                  <th scope="col">@sortablelink('tutor_id','Padre / Encargado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($payments as $payment)
                  <tr>
                    <td data-label="Categoría" scope="row"><a
                        href="{{ action('PaymentController@detail', ['id' => $payment->id]) }}" />
                      {{ $payment->paymentcategory->name }}
                    </td>
                    <td data-label="Ciclo"><a href="{{ action('PaymentController@detail', ['id' => $payment->id]) }}" />
                      {{ $payment->cycle->name }}
                      </a>
                    </td>
                    <td data-label="Referencia"><a
                        href="{{ action('PaymentController@detail', ['id' => $payment->id]) }}" />
                      {{ $payment->code_reference }}
                      </a>
                    </td>
                    <td data-label="Estudiante"><a
                        href="{{ action('PaymentController@detail', ['id' => $payment->id]) }}" />
                      {{ $payment->student->student_code }}
                      <br>
                      {{ $payment->student->person->names }}
                      {{ $payment->student->person->first_surname }}
                      </a>
                    </td>
                    <td data-label="Estudiante"><a
                        href="{{ action('PaymentController@detail', ['id' => $payment->id]) }}" />
                      {{ $payment->tutor->dpi }}
                      <br>
                      {{ $payment->tutor->person->names }}
                      {{ $payment->tutor->person->first_surname }}
                      </a>
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            {{ $payments->appends(Request::except('page'))->render() }}
            <br>
            Se muestran {{ $payments->count() }} de {{ $payments->total() }} pagos
            registrados.

          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    async function changeStatus(id) {
      try {
        const badge = $(`#status${id}`);
        let status = badge.text().trim();

        status = await axios.post('/cycle/status', {
            id,
            status
          })
          .then(data => {
            const response = data.data;
            const {
              status
            } = response.data;

            badge
              .removeClass(status === 'INACTIVO' ? 'badge-success' : 'badge-danger')
              .addClass(status === 'INACTIVO' ? 'badge-danger' : 'badge-success');
            badge.text(status);

            return status;
          })
          .catch(err => console.error(err));
      } catch (error) {
        console.error(error);
      }
    }

  </script>

@endsection
