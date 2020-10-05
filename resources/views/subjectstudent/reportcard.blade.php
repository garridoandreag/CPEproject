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
          <div class="card-header">Boleta de Notas</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a class="btn btn-outline-primary" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Elegir Ciclo
                  </button>
                </div>
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

            @if (isset($reports))
              <table class="table table-hover">

                <thead>
                  <tr>
                    <th scope="col">@sortablelink('course_id','Curso')</th>
                    @foreach ($reports as $report)
                      <th scope="col">@sortablelink('course_id',$report->unit)
                      </th>
                    @endforeach
                  </tr>
                </thead>
                <tbody id="myTable">
                  <tr>
                    <td data-label="Curso" scope="row">
                      {{ $report->name }}
                    </td>
                    @foreach ($reports as $report)
                      <td data-label="Nota" scope="row">
                        {{ $report->score }}
                      </td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
            @else
              <br>
              <p class="text-center">No se encontraron datos</p>
            @endif

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
