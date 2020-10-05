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
          <div class="card-header">Inscripciones del Estudiante</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('StudentController@index') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="{{ action('SubjectstudentController@create', ['student_id' => $student_id]) }}" class="btn btn-primary">Nuevo </a>
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

            @if (isset($subjectstudents))
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">@sortablelink('cycle_id','Ciclo')</th>
                    <th scope="col">@sortablelink('student_id','Estudiante')</th>
                    <th scope="col">@sortablelink('grade_id','Grado')</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                  @foreach ($subjectstudents as $subjectstudent)
                    <tr>
                      <td data-label="Ciclo" scope="row">
                        {{ $subjectstudent->cycle->name}}
                      </td>

                      <td data-label="Estudiante" scope="row">
                        {{ $subjectstudent->student->person->names }}
                      </td>

                      <td data-label="Grado" scope="row">
                        {{ $subjectstudent->grade->name }}
                      </td>

                    </tr>
                  @endforeach
                </tbody>
              </table>
              <br>
              {{ $subjectstudents->appends(Request::except('page'))->render() }}
              <br>
              <p>
                Se muestran {{ $subjectstudents->count() }} de {{ $subjectstudents->total() }} cursos.
              </P>
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
