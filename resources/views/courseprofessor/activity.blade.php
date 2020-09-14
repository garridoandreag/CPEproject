@extends('layouts.app')

@section('content')
  @inject('units','App\Services\Units')
  <script src="{{ asset('js/app.js') }}"></script>
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
          <div class="card-header">Actividades</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('CoursegradeController@courseprofessor') }}" class="btn btn-outline-primary">Regresar
                </a>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-light active">
                    <input type="radio" name="options" id="unit_all" checked> Todo
                  </label>
                  @foreach ($activities as $activity)
                    <label class="btn btn-light">
                      <input type="radio" name="unit" id="{{ 'unit' . $activity->unit_id }}"
                        value="{{ $activity->unit_id }}">{{ $activity->unit->name }}
                    </label>
                  @endforeach
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

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('unit_id','Unidad')</th>
                  <th scope="col">@sortablelink('course_id','Asignatura')</th>
                  <th scope="col">@sortablelink('grade_id','Grado')</th>
                  <th scope="col">@sortablelink('name','Actividad')</th>
                  <th scope="col">@sortablelink('score','Puntos')</th>
                  <th scope="col">Tareas</th>
                  <th scope="col">@sortablelink('delivery_date','Fecha Entrega')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($activities as $activity)
                  <tr>
                    <td data-label="Asignatura" scope="row"><a
                        href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                      {{ $activity->unit->name }}
                    </td>
                    <td data-label="Asignatura" scope="row"><a
                        href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                      {{ $activity->coursegrade->course->name }}
                    </td>
                    <td data-label="Grado"><a href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                      {{ $activity->coursegrade->grade->name }}
                      </a>
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
                    <td data-label="Puntos"><a
                      href="{{ action('HomeworkController@create', ['activity_id' => $activity->id]) }}" />
                      Listar estudiantes
                    </a>
                  </td>
                    <td data-label="Fecha de Entrega"><a
                        href="{{ action('ActivityController@detail', ['id' => $activity->id]) }}" />
                      {{ $activity->delivery_date }}
                      </a>
                    </td>

                    <td data-label="Estado">
                      @if ($activity->status == 'INACTIVO')
                        <span id="status{{ $activity->id }}" onclick="changeStatus({{ $activity->id }})"
                          class="status badge badge-danger">
                          {{ $activity->status }}
                        </span>
                      @else
                        <span id="status{{ $activity->id }}" onclick="changeStatus({{ $activity->id }})"
                          class="status badge badge-success">
                          {{ $activity->status }}
                        </span>
                      @endif
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>


            {{ $activities->appends(Request::except('page'))->render() }}

            <p>
              Se muestran {{ $activities->count() }} de {{ $activities->total() }} actividades.
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
