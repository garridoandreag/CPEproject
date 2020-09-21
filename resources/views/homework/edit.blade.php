@extends('layouts.app')

@section('content')
  @inject('PMs','App\Services\PMs')
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
          <div class="card-header">Tareas: {{ $course_name }} {{ $grade_name }}</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0">{{ $activity_name }}</h5>
                    {{ $activity_description }}
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
            <form id="homeworkForm" method="POST"
              action="{{ isset($homeworks) ? route('homework.update') : route('homework.store') }}"
              enctype="multipart/form-data" aria-label="tareas">
              {{ csrf_field() }}

              <table class="table table-bordered">
                <thead>
                  <tr>
                    
                    <th scope="col">@sortablelink('unit_id','Unidad')</th>
                    <th scope="col">@sortablelink('subjectstudent_id','Estudiante')</th>
                    <th scope="col">@sortablelink('points','Puntos')</th>
                    <th scope="col">@sortablelink('PM','Proceso Mejora (P.M.)')</th>
                    <th scope="col">@sortablelink('delivery_date','Fecha Entregado')</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                  <input type="hidden" name="coursegrade_id" value="{{ $coursegrade_id }}" /><br>

                  @foreach ($homeworks as $homework)
                    <tr>
                      <input type="hidden" name="id[]" value="{{ $homework->id }}" />
                      <td data-label="Unidad" scope="row">
                        {{ $homework->unit->name }}
                      </td>
                      <td data-label="Estudiante">
                        {{ $homework->subjectstudent->student->person->names }}
                        {{ $homework->subjectstudent->student->person->first_surname }}
                        <input type="hidden" name="activity_id[]" value="{{ $homework->activity_id }}" />
                      </td>

                      <td data-label="Puntos" scope="row">
                        <div class="input-group input-group-sm mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"> {{$homework->activity->score}} / </span>
                          </div>
                        <input id="points" type="number" step="any" min="0" max="{{$homework->activity->score}}"
                            class="form-control form-control-sm @error('points') is-invalid @enderror" name="points[]"
                            value="{{ $homework->points ?? '' }}" autocomplete="points" autofocus>
                        </div>

                      </td>

                      <td data-label="Proceso Mejora (P.M.)" scope="row">
                        <select id="PM" name="PM[]"
                          class="form-control form-control-sm  @error('PM') is-invalid @enderror">
                          @foreach ($PMs->get() as $index => $PM)

                            <option value="{{ $index }}" {{ old('PM', $homework->PM ?? '') == $index ? 'selected' : '' }}>
                              {{ $PM }}
                            </option>

                          @endforeach
                        </select>
                      </td>

                      <td data-label="Fecha de Entrega" scope="row">
                        <input id="delivery_date" type="date"
                          class="form-control form-control-sm @error('delivery_date') is-invalid @enderror"
                          name="delivery_date[]" value="{{ $homework->delivery_date ?? '' }}" autocomplete="points"
                          autofocus>
                      </td>
                    </tr>
                  @endforeach



                </tbody>
              </table>

              <br>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-0">
                  <a href="{{ action('ActivityController@courseprofessoractivity', ['coursegrade_id' => $coursegrade_id]) }}" " class="
                    btn btn-outline-primary">Regresar </a>

                  <button type="submit" class="btn btn-primary">
                    @if (isset($homeworks) && is_object($homeworks))
                      Actualizar
                    @else
                      Guardar
                    @endif
                  </button>

                </div>
              </div>

            </form>

            <br>

            {{ $homeworks->appends(Request::except('page'))->render() }}
            <br>

            <p>
              Se muestran {{ $homeworks->count() }} de {{ $homeworks->total() }} tareas.
            </P>

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
