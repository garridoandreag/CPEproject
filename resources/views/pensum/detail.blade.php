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
          <div class="card-header">Pensum </div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="{{ action('PensumController@edit', ['grade_id' => $grade_id]) }}" class="btn btn-primary">Modificar</a>
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
                  <th scope="col">@sortablelink('grade_id','Grado')</th>
                  <th scope="col">@sortablelink('course_id','Curso')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($pensums as $pensum)
                  <tr>
                    <td data-label="Ciclo" scope="row">
                      {{ $pensum->grade->name }}</a>
                    </td>

                    <td data-label="Curso" scope="row">
                      {{ $pensum->course->name }}</a>
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            {{ $pensums->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $pensums->count() }} de {{ $pensums->total() }} cursos planeados.
            </P>

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
