@extends('layouts.app')

@section('content')
@inject('grades','App\Services\Grades')
@inject('st','App\Services\Students')
<script src="{{ asset('js/axios.js') }}" ></script>
  <style>
    .status {
      cursor: pointer;
    }

  </style>
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
          <div class="card-header">Estudiantes
          </div>

          <div class="card-body">
            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('StudentController@create') }}" class="btn btn-primary">Nuevo </a>
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
            
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">Código</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Grado</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Asignar Cursos</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($students as $student)
                  <tr>
                    <td data-label="Código" scope="row"><a
                        href="{{ action('StudentController@detail', ['id' => $student->id]) }}" />
                      {{ $student->student_code }}
                    </td>
                    <td data-label="Nombres"><a href="{{ action('StudentController@detail', ['id' => $student->id]) }}" />
                      {{ $student->person->names }}
                      </a>
                    </td>
                    <td data-label="Apellidos"><a
                        href="{{ action('StudentController@detail', ['id' => $student->id]) }}" />
                      {{ $student->person->first_surname }}
                      {{ $student->person->second_surname }}
                      </a>
                    </td>
                    <td data-label="Foto"><a href="{{ action('StudentController@detail', ['id' => $student->id]) }}" />
                      @if ($student->person->picture)
                        <div class="container-person_profile">
                          <img src="{{ route('student.picture', ['filename' => $student->person->picture]) }}"
                            class="picture_profile" />
                        </div>
                      @endif
                      </a>
                    </td>
                    <td data-label="Grado"><a href="{{ action('StudentController@detail', ['id' => $student->id]) }}" />
                      @foreach ($grades->get() as $index => $grade)
                          {{ old('grade_id', $st->getStudentGrade($student->id) ?? '') == $index ? $grade : '' }}
                      @endforeach
                    </a>
                    </td>
                    <td data-label="Estado">
                      @if ($student->status == 'INACTIVO')
                            <span id="status{{ $student->id }}" onclick="changeStatus({{ $student->id }})"
                              class="status badge badge-danger">
                              {{ $student->status }}
                            </span>
                          @else
                            <span id="status{{ $student->id }}" onclick="changeStatus({{ $student->id }})"
                              class="status badge badge-success">
                              {{ $student->status }}
                            </span>
                      @endif
                    </td>

                    <td data-label="Asignar Cursos">
                      <a class="btn btn-primary btn-sm"
                        href="{{ action('SubjectstudentController@inscription', ['student_id' => $student->id]) }}" />
                        <i class="fas fa-th-list"></i>
                      Asignar Cursos
                      </a>
                    </td>
                  </tr>
                @endforeach


              </tbody>

            </table>
            <br>

            {{ $students->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $students->count() }} de {{ $students->total() }} estudiantes.
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
        
        status = await axios.post('/student/status', {
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
