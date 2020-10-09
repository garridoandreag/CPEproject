@extends('layouts.app')

@section('content')
  @inject('units','App\Services\Units')
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
          <div class="card-header">Boleta de Notas</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a class="btn btn-outline-primary" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                <a class="btn btn-outline-primary" href="{{ action('SubjectstudentController@reportcardPDF', ['cycle_id' => $cycle_id,'student_id' => $student_id]) }}"><i class="fas fa-print"></i></a>

                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Elegir Ciclo
                  </button>
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

            @if (isset($reports))
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('name','Asignatura')</th>
                  <th scope="col">@sortablelink('bloque1','1° Bloque')</th>
                  <th scope="col">@sortablelink('bloque2','2° Bloque')</th>
                  <th scope="col">@sortablelink('bloque3','3° Bloque')</th>
                  <th scope="col">@sortablelink('bloque4','4° Bloque')</th>
                  <th scope="col">@sortablelink('total','Nota Final')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($reports as $report)
                  <tr>
                    <td data-label="Curso" scope="row">
                      {{ $report->name }}
                    </td>
                    <td data-label="1° Bloque" scope="row">
                      {{ $report->bloque1 }}
                    </td>
                    <td data-label="2° Bloque" scope="row">
                      {{ $report->bloque2 }}
                    </td>
                    <td data-label="3° Bloque" scope="row">
                      {{ $report->bloque3 }}
                    </td>
                    <td data-label="4° Bloque" scope="row">
                      {{ $report->bloque4 }}
                    </td>
                    <td data-label="Nota Final" scope="row">
                      {{ $report->total }}
                    </td>
                  </tr>
                @endforeach


              </tbody>

            </table>
            @else
              <br>
              <p class="text-center">No se encontraron datos</p>
            @endif

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
