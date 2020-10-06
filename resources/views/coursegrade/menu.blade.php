@extends('layouts.app')

@section('content')
  @inject('cycles', 'App\Services\Cycles')
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
          <div class="card-header">Planeación de cursos</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Elegir Ciclo
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    @foreach ($cycles->getAll() as $index => $cycle)
                      <a class="dropdown-item"
                        href="{{ action('CoursegradeController@menu', ['cycle_id' => $index]) }}">{{ $cycle }}</a>
                    @endforeach

                  </div>
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
                  <th scope="col">@sortablelink('cycle_id','Ciclo')</th>
                  <th scope="col">@sortablelink('grade_id','Grado')</th>
                  <th>Opción</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($coursegrades as $coursegrade)
                  <tr>
                    <td data-label="Ciclo" scope="row">
                      {{ $coursegrade->cycle->name }}
                    </td>

                    <td data-label="Grado" scope="row">
                      {{ $coursegrade->grade->name }}
                    </td>

                    <td data-label="Opción"><a class="btn btn-primary btn-sm"
                        href="{{ action('CoursegradeController@detail', ['cycle_id' => $coursegrade->cycle_id,'grade_id' => $coursegrade->grade_id]) }}" />
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
