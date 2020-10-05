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
          <div class="card-header">Cursos del Estudiante</div>
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

            @if (isset($subjectstudents))
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">@sortablelink('cycle_id','Ciclo')</th>
                    <th scope="col">@sortablelink('student_id','Estudiante')</th>
                    <th scope="col">@sortablelink('grade_id','Grado')</th>
                    <th scope="col">@sortablelink('course_id','Curso')</th>
                    <th scope="col">@sortablelink('score_subject','Nota')</th>
                    <th scope="col">@sortablelink('status','Estado')</th>
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

                      <td data-label="Curso" scope="row">
                        {{ $subjectstudent->coursegrade->course->name}}
                      </td>

                      <td data-label="Nota" scope="row">
                        {{ $subjectstudent->score_subject}}
                      </td>

                      <td data-label="Estado">
                        @if ($subjectstudent->status == 'INACTIVO')
                          <span id="status{{ $subjectstudent->id }}" onclick="changeStatus({{ $subjectstudent->id }})"
                            class="status badge badge-danger">
                            {{ $subjectstudent->status }}
                          </span>
                        @else
                          <span id="status{{ $subjectstudent->id }}" onclick="changeStatus({{ $subjectstudent->id }})"
                            class="status badge badge-success">
                            {{ $subjectstudent->status }}
                          </span>
                        @endif
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
