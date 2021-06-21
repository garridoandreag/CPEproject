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
          <div class="card-header">Grados</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="{{ action('GradeController@create') }}" class="btn btn-primary">Nuevo </a>
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
            @else
              @if (session('warning'))
              <div class="alert alert-danger">
                {{ session('warning') }}
              </div>
              @endif
            @endif
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('name','Nombre')</th>
                  <th scope="col">@sortablelink('section','Sección')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($grades as $grade)
                  <tr>
                    <td data-label="Nombre" scope="row"><a
                        href="{{ action('GradeController@detail', ['id' => $grade->id]) }}" />
                      {{ $grade->name }}
                    </td>
                    <td data-label="Sección"><a href="{{ action('GradeController@detail', ['id' => $grade->id]) }}" />
                      {{ $grade->section }}
                      </a>
                    </td>

                    <td data-label="Estado">
                      @if ($grade->status == 'INACTIVO')
                        <span id="status{{ $grade->id }}" onclick="changeStatus({{ $grade->id }})"
                          class="status badge badge-danger">
                          {{ $grade->status }}
                        </span>
                      @else
                        <span id="status{{ $grade->id }}" onclick="changeStatus({{ $grade->id }})"
                          class="status badge badge-success">
                          {{ $grade->status }}
                        </span>
                      @endif
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            {{ $grades->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $grades->count() }} de {{ $grades->total() }} grados.
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

        status = await axios.post('/grade/status', {
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
