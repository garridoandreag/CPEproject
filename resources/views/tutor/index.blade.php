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
    <style>
      .status {
        cursor: pointer;
      }
  
    </style>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Padres (Encargados)</div>
          <div class="card-body">
            <div class="row justify-content-md-center">
              <div class="col">
                <a class="btn btn-outline-primary" href="{{route('home')}}"><i class="fas fa-home"></i></a>
                @if (Auth::user()->role_id <= 2)
                <a href="{{ action('TutorController@create') }}" class="btn btn-primary">Nuevo </a>
                @endif
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
                  <th scope="col">Estudiante</th>
                  <th scope="col">Padre / Madre /Encargado</th>
                  <th scope="col">Numero Teléfonico</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($tutors as $tutor)
                  <tr>
                    <td data-label="Padre / Madre /Encargado"><a
                        href="{{ action('TutorController@detail', ['id' => $tutor->id]) }}" />
                        @foreach ($students as $student)
                        @if($student->tutor_id == $tutor->id)
                        ({{ $student->student_code }})
                        {{ $student->names }}
                        {{ $student->first_surname }}
                        @endif
                        @endforeach
                      
                      </a>
                    </td>

                    <td data-label="Padre / Madre /Encargado"><a
                        href="{{ action('TutorController@detail', ['id' => $tutor->id]) }}" />
                      {{ $tutor->person->names }}
                      {{ $tutor->person->first_surname }}
                      {{ $tutor->person->second_surname }}
                      </a>
                    </td>
                    <td data-label="Numero Telefónico"><a
                        href="{{ action('TutorController@detail', ['id' => $tutor->id]) }}" />
                      {{ $tutor->person->phone_number }}
                      <br>
                      {{ $tutor->person->cellphone_number }}
                      </a>
                    </td>
                    <td>
                      @if ($tutor->status == 'INACTIVO')
                        <span id="status{{$tutor->id}}" onclick="changeStatus({{$tutor->id}})" class="status badge badge-danger">
                          {{ $tutor->status }}
                        </span>
                      @else
                        <span id="status{{ $tutor->id }}" onclick="changeStatus({{ $tutor->id }})"
                          class="status badge badge-success">
                          {{ $tutor->status }}
                        </span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            {{ $tutors->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $tutors->count() }} de {{ $tutors->total() }} padres / encargados.
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

        status = await axios.post('/tutor/status', {
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
