@extends('layouts.app')

@section('content')
@inject('professors','App\Services\Professors')

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

            <form id="homeworkForm" method="POST"
            action="{{ isset($coursegrades) ? route('coursegrade.update') : route('coursegrade.store') }}"
            enctype="multipart/form-data" aria-label="tareas">
            {{ csrf_field() }}

            <input type="hidden" name="cycle" value="{{ $cycle_id }}" />
            <input type="hidden" name="grade" value="{{ $grade_id }}" />

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
                    <input type="hidden" name="id[]" value="{{ $coursegrade->id }}" />
                    <td data-label="Ciclo" scope="row">
                      {{ $coursegrade->cycle->name }}
                    </td>

                    <td data-label="Curso" scope="row">
                      {{ $coursegrade->course->name }}
                    </td>

                    <td data-label="Grado" scope="row">
                      {{ $coursegrade->grade->name }}
                    </td>

                    <td data-label="Docente">
                          <select id="employee_id" name="employee_id[]"
                            class="form-control form-control-sm  @error('employee_id') is-invalid @enderror">
                            @foreach ($professors->get() as $index => $employee)
                              <option value="{{ $index }}"
                                {{ old('employee_id', $coursegrade->employee_id ?? '') == $index ? 'selected' : '' }}>
                                {{ $employee }}
                              </option>
                            @endforeach
                          </select>
                    </td>

                    <td data-label="Tareas" scope="row"><a
                        href="{{ action('HomeworkController@homeworkcourse', ['coursegrade_id' => $coursegrade->id]) }}" />
                      Tareas
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
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-9">
                <a href="{{ action('CoursegradeController@detail', ['cycle_id' => $cycle_id,'grade_id' => $grade_id]) }}" " class="
                  btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                  @if (isset($coursegrades) && is_object($coursegrades))
                    Actualizar
                  @else
                    Guardar
                  @endif
                </button>

              </div>
            </div>

          </form>


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
