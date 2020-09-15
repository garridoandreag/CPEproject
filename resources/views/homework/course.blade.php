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
          <div class="card-header">Tareas </div>
          <div class="card-body">


            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('CycleController@create') }}" class="btn btn-primary">Nuevo </a>
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


            <form id="studentForm" method="POST" action="
                      {{ isset($homeworks) ? route('homework.update') : route('homework.store') }}"
              enctype="multipart/form-data" aria-label="Configuración de mi cuenta">
              {{ csrf_field() }}
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">@sortablelink('student_id','Estudiante')</th>
                    @foreach ($activities as $activity)
                      <th scope="col">@sortablelink('points',$activity->name) Puntos: {{ $activity->score }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody id="myTable">
                  @foreach ($subjectstudents as $subjectstudent)
                    <tr>
                      <td data-label="Estudiante">
                        {{ $subjectstudent->student->person->names }}
                        {{ $subjectstudent->student->person->first_surname }}
                        {{ $subjectstudent->student->person->second_surname }}
                      </td>

                      @foreach ($homeworks as $homework)
                        @if ($subjectstudent->id == $homework->subjectstudent_id)
                          <td data-label="{{ $homework->activity->name }}" scope="row">
                            <div class="input-group input-group-sm mb-3">
                              <input id="points" type="number"
                                class="form-control form-control-sm @error('points') is-invalid @enderror" name="points[]"
                                value="{{ $homework->points ?? '' }}" autocomplete="points" autofocus>
                              <div class="input-group-prepend">
                                <span class="input-group-text form-control-sm" value="1">P.M.</span>
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                              </div>

                            </div>
                          </td>
                        @endif
                      @endforeach

                    </tr>
                  @endforeach
                </tbody>
              </table>
              <br>
              <div class="form-group row mb-0">
                <div class="col-md-12">
                  <a href="{{ route('courseprofessor.index') }}" class="btn btn-outline-primary">Regresar </a>

                  <button type="submit" class="btn btn-primary">
                    Guardar
                  </button>
                </div>
              </div>


            </form>

            <br>

            {{ $homeworks->appends(Request::except('page'))->render() }}
            <br>

            <p>
              Se muestran {{ $homeworks->count() }} de {{ $homeworks->total() }} tareas de estudiantes.
            </P>

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
