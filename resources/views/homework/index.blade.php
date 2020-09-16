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
          <div class="card-header">Tareas </div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                
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
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('activity_id','Actividad')</th>
                  <th scope="col">@sortablelink('subjectstudent_id','Estudiante')</th>
                  <th scope="col">@sortablelink('unit_id','Unidad')</th>
                  <th scope="col">@sortablelink('points','Puntos')</th>
                  <th scope="col">@sortablelink('delivery_date','Fecha Entregado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($homeworks as $homework)
                  <tr>
                    <td data-label="Actividad" scope="row"><a
                        href="{{ action('HomeworkController@detail', ['id' => $homework->id]) }}" />
                      {{ $homework->activity->name }}
                    </td>
                    <td data-label="Estudiante"><a
                        href="{{ action('HomeworkController@detail', ['id' => $homework->id]) }}" />
                      {{ $homework->subjectstudent->student->person->names }}
                      </a>
                    </td>
                    <td data-label="Unidad" scope="row"><a
                        href="{{ action('HomeworkController@detail', ['id' => $homework->id]) }}" />
                      {{ $homework->unit_id }}
                    </td>

                    <td data-label="Puntos" scope="row">
                      <input id="points" type="text"
                        class="form-control form-control-sm @error('points') is-invalid @enderror" name="points[]"
                        value="{{ $homework->points ?? '' }}" autocomplete="points" autofocus>
                    </td>
                    <td data-label="Puntos" scope="row">
                      <input id="points" type="date"
                        class="form-control form-control-sm @error('points') is-invalid @enderror" name="points[]"
                        value="{{ $homework->delivery_date ?? '' }}" autocomplete="points" autofocus>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>

            {{ $homeworks->appends(Request::except('page'))->render() }}
            <br>

            <p>
              Se muestran {{ $homeworks->count() }} de {{ $homeworks->total() }} ciclos.
            </P>

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
