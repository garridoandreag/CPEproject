@extends('layouts.app')

@section('content')
@inject('cycles', 'App\Services\Cycles')
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
          <div class="card-header">Listado de Estudiantes
          </div>

          <div class="card-body">
            <div class="row justify-content-md-center">
              <div class="col">
                <a class="btn btn-outline-primary" href="{{ route('student.grade') }}"><i class="fas fa-reply"></i></a>
                
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Elegir Ciclo
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    @foreach ($cycles->getAll() as $index => $cycle)
                      <a class="dropdown-item"
                        href="{{ action('StudentController@list', ['grade_id' => $grade_id, 'cycle_id' => $index]) }}">{{ $cycle }}</a>
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
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('student_code','Código')</th>
                  <th scope="col">@sortablelink('names','Nombre')</th>
                  <th scope="col">@sortablelink('first_surname','Apellidos')</th>
                  <th scope="col">@sortablelink('picture','Foto')</th>
                  <th scope="col">@sortablelink('grade','Grado')</th>
                  <th scope="col">@sortablelink('cycle','Ciclo')</th>
                  <th scope="col">@sortablelink('','Opciones')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($liststudents as $liststudent)
                  <tr>
                    <td data-label="Código" scope="row">
                      {{  $liststudent->student_code }}
                    </td>

                    <td data-label="Nombre">
                      {{  $liststudent->names }}
                    </td>

                    <td data-label="Apellidos">
                      {{  $liststudent->first_surname }}
                      {{  $liststudent->second_surname }}
                    </td>

                    <td data-label="Foto">
                      @if ( $liststudent->picture)
                        <div class="container-person_profile">
                          <img src="{{ route('student.picture', ['filename' =>  $liststudent->picture]) }}"
                            class="picture_profile" />
                        </div>
                      @endif
                    </td>

                    <td data-label="Grado">
                      {{  $liststudent->grade }}
                    </td>

                    <td data-label="Ciclo">
                      {{  $liststudent->cycle}}
                    </td>
                    
                    <td data-label="Opciones">
                      <a class="btn btn-primary btn-sm"
                      href="{{ action('SubjectstudentController@reportcard', ['cycle_id' =>  $liststudent->cycle_id,'student_id' =>  $liststudent->id]) }}" />
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
