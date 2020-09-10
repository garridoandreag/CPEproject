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
          <div class="card-header">PROFESOR: MIS CURSOS</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('CoursegradeController@create') }}" class="btn btn-primary">Nuevo </a>
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
                  <th scope="col">@sortablelink('cycle_id','Ciclo')</th>
                  <th scope="col">@sortablelink('course_id','Curso')</th>
                  <th scope="col">@sortablelink('grade_id','Grado')</th>
                  <th scope="col">@sortablelink('employee_id','Docente')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($coursegrades as $coursegrade)
                  <tr>
                    <td data-label="Ciclo" scope="row"><a href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' =>$coursegrade->id]) }}" />
                      {{ $coursegrade->cycle->name }}
                    </td>

                    <td data-label="Curso" scope="row"><a href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' =>$coursegrade->id]) }}" />
                      {{ $coursegrade->course->name }}
                    </td>

                    <td data-label="Grado" scope="row"><a href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' =>$coursegrade->id]) }}" />
                      {{ $coursegrade->grade->name }}
                    </td>

                    <td data-label="Docente"><a href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' =>$coursegrade->id]) }}" />
                      {{ $coursegrade->employee->person->names }}
                      {{ $coursegrade->employee->person->first_surname }}
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

            {{ $coursegrades->appends(Request::except('page'))->render() }}

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

        status = await axios.post('/subject/status', {
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
