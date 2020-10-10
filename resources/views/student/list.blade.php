@extends('layouts.app')

@section('content')
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
            @endif
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('student_code','Código')</th>
                  <th scope="col">@sortablelink('names','Nombre')</th>
                  <th scope="col">@sortablelink('first_surname','Apellidos')</th>
                  <th scope="col">@sortablelink('picture','Foto')</th>
                  <th scope="col">@sortablelink('cycle','Ciclo')</th>
                  <th scope="col">@sortablelink('grade','Grado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($liststudents as $student)
                  <tr>
                    <td data-label="Código" scope="row">
                      {{ $student->student_code }}
                    </td>

                    <td data-label="Nombre">
                      {{ $student->names }}
                    </td>

                    <td data-label="Apellidos">
                      {{ $student->first_surname }}
                      {{ $student->second_surname }}
                    </td>

                    <td data-label="Foto">
                      @if ($student->picture)
                        <div class="container-person_profile">
                          <img src="{{ route('student.picture', ['filename' => $student->picture]) }}"
                            class="picture_profile" />
                        </div>
                      @endif
                    </td>


                    <td data-label="Opciones">
                      <a class="btn btn-primary btn-sm"
                      href="{{ action('SubjectstudentController@reportcard', ['cycle_id' => $student->cycle_id,'student_id' => $student->id]) }}" />
                      <i class="fas fa-th-list"></i>
                    Boleta de Notas
                    </a>
                    </td>

                  </tr>
                @endforeach


              </tbody>

            </table>
            <br>

            {{ $liststudents->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $liststudents->count() }} de {{ $liststudents->total() }} estudiantes.
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
