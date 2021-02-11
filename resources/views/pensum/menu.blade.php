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

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Pensum por grado</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
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
                  <th scope="col">@sortablelink('id','Grado')</th>
                  <th>Opción</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($grades as $grade)
                  <tr>
                    <td data-label="Grado" scope="row">
                      {{ $grade->name }}
                    </td>

                    <td data-label="Opción"><a class="btn btn-primary btn-sm"
                        href="{{ action('PensumController@detail', ['grade_id' => $grade->id]) }}" />
                        <i class="fas fa-chalkboard-teacher"></i>
                      Asignar
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
