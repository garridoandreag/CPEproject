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
          <div class="card-header">Planeación de cursos</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="{{ action('CoursegradeController@edit', ['cycle_id' => $cycle_id,'grade_id' => $grade_id]) }}" class="btn btn-primary">Modificar</a>
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
                  <th scope="col">@sortablelink('course_id','Curso')</th>
                  <th scope="col">@sortablelink('grade_id','Grado')</th>
                  <th scope="col">@sortablelink('employee_id','Docente')</th>
                  <th scope="col">@sortablelink('homework','Tareas')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($coursegrades as $coursegrade)
                  <tr>
                    <td data-label="Ciclo" scope="row">
                      {{ $coursegrade->cycle->name }}</a>
                    </td>

                    <td data-label="Curso" scope="row">
                      {{ $coursegrade->course->name }}</a>
                    </td>

                    <td data-label="Grado" scope="row">
                      {{ $coursegrade->grade->name }}</a>
                    </td>

                    <td data-label="Docente">
                      {{ $coursegrade->employee->person->names ?? '' }}
                      {{ $coursegrade->employee->person->first_surname ?? '' }}
                      </a>
                    </td>

                    <td data-label="Tareas" scope="row"><a class="btn btn-primary btn-sm"
                      href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' => $coursegrade->id]) }}" />
                      <i class="fas fa-spell-check"></i>Tareas
                    </a>
                    </td>

                    <td data-label="Estado">
                      @if ($coursegrade->status == 'INACTIVO')
                        <span id="status{{ $coursegrade->id }}" onclick="changeStatus({{ $coursegrade->id }})"
                          class="status badge badge-danger">
                          {{ $coursegrade->status }}
                        </span>
                      @else
                        <span id="status{{ $coursegrade->id }}" onclick="changeStatus({{ $coursegrade->id }})"
                          class="status badge badge-success">
                          {{ $coursegrade->status }}
                        </span>
                      @endif
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            {{ $coursegrades->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $coursegrades->count() }} de {{ $coursegrades->total() }} cursos planeados.
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

        status = await axios.post('/coursegrade/status', {
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
