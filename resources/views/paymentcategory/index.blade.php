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
          <div class="card-header">Categorias de Pago</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="{{ action('PaymentcategoryController@create') }}" class="btn btn-primary">Nuevo
                </a>
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
                  <th scope="col">@sortablelink('name','Nombre')</th>
                  <th scope="col">@sortablelink('description','Descripción')</th>
                  <th scope="col">@sortablelink('payment_date','Fecha de Pago')</th>
                  <th scope="col">@sortablelink('amount','Cantidad')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($paymentcategories as $paymentcategory)
                  <tr>
                    <td data-label="Nombre" scope="row"><a
                        href="{{ action('PaymentcategoryController@detail', ['id' => $paymentcategory->id]) }}" />
                      {{ $paymentcategory->name }}
                    </td>
                    <td data-label="Descripción"><a
                        href="{{ action('PaymentcategoryController@detail', ['id' => $paymentcategory->id]) }}" />
                      {{ substr($paymentcategory->description, 0, 50) }}
                      </a>
                    </td>
                    <td data-label="Fecha de Pago"><a
                        href="{{ action('PaymentcategoryController@detail', ['id' => $paymentcategory->id]) }}" />
                      {{ $paymentcategory->payment_date }}
                      </a>
                    </td>
                    <td data-label="Monto"><a
                        href="{{ action('PaymentcategoryController@detail', ['id' => $paymentcategory->id]) }}" />
                      {{ $paymentcategory->amount }}
                      </a>
                    </td>
                    <td data-label="Estado">
                      @if ($paymentcategory->status == 'INACTIVO')
                        <span id="status{{ $paymentcategory->id }}" onclick="changeStatus({{ $paymentcategory->id }})"
                          class="status badge badge-danger">
                          {{ $paymentcategory->status }}
                        </span>
                      @else
                        <span id="status{{ $paymentcategory->id }}" onclick="changeStatus({{ $paymentcategory->id }})"
                          class="status badge badge-success">
                          {{ $paymentcategory->status }}
                        </span>
                      @endif
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            {{ $paymentcategories->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $paymentcategories->count() }} de {{ $paymentcategories->total() }} categorias de pago.
            </P>

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

        status = await axios.post('/paymentcategory/status', {
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
