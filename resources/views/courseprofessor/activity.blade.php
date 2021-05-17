@extends('layouts.app')

@section('content')
  @inject('units','App\Services\Units')
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
          <div class="card-header">Actividades: {{ $course_name }} {{ $grade_name }}</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                @if(Auth::user()->role_id == 3)
                <a href="{{ action('CoursegradeController@courseprofessor') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i>
                </a>
                <a href="{{ action('ActivityController@create', ['employee_id' => $employee_id,'coursegrade_id' => $coursegrade_id]) }}" class="btn btn-primary">Nuevo
                </a>
                @else
                  @if(Auth::user()->role_id <= 2)
                  <a href="{{ action('CoursegradeController@detail', ['cycle_id' => $cycle_id,'grade_id' => $grade_id]) }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i>
                  </a>
                  @endif
                @endif

                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Elegir Unidad
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item"
                      href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' => $coursegrade_id]) }}">Mostrar
                      todo</a>
                    @foreach ($units->get() as $index => $unit)
                      <a class="dropdown-item"
                        href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' => $coursegrade_id, 'unit_id' => $index]) }}">{{ $unit }}</a>
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
            @endif
            
            @if (isset($activities))
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">@sortablelink('unit_id','Unidad')</th>
                    <th scope="col">@sortablelink('name','Actividad')</th>
                    <th scope="col">@sortablelink('score','Puntos')</th>
                    <th scope="col">@sortablelink('delivery_date','Fecha Entrega')</th>
                    <th scope="col">Tareas</th>
                  </tr>
                </thead>
                <tbody id="myTable">

                  @foreach ($activities as $activity)
                    <tr>
                      <td data-label="Asignatura" scope="row"><a
                          href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                        {{ $activity->unit->name }}
                      </td>
                      <td data-label="Actividad"><a
                          href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                        {{ $activity->name }}
                        </a>
                      </td>
                      <td data-label="Puntos"><a
                          href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                        {{ $activity->score }}
                        </a>
                      </td>
                      <td data-label="Fecha de Entrega"><a
                          href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                        {{ $activity->delivery_date }}
                        </a>
                      </td>
                      <td data-label="Puntos"><a class="btn btn-primary btn-sm"
                          href="{{ action('HomeworkController@edit', ['activity_id' => $activity->id]) }}" />
                        <i class="fas fa-list-alt"></i>
                        Calificar
                        </a>
                      </td>
                    </tr>
                  @endforeach


                </tbody>
              </table>
              <br>

              {{ $activities->appends(Request::except('page'))->render() }}
              <br>
              <p>
                Se muestran {{ $activities->count() }} de {{ $activities->total() }} actividades.
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
