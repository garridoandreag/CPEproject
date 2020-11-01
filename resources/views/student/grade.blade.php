@extends('layouts.app')

@section('content')
  @inject('grades', 'App\Services\Grades')
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
          <div class="card-header">Estudiantes por Grado</div>
          <div class="card-body">


              @foreach ($grades->getAllActive() as $index => $grade)

              <a href="{{ action('StudentController@list', ['grade_id' => $index]) }}" class="btn btn-light" id="menu-admin">{{ $grade }}
                <img src="{{URL::asset('images/'.$index.'.png')}}" class="btn-menu">
                <br>
                </a>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

@endsection
