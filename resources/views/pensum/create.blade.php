@extends('layouts.app')

@section('content')
  @inject('courses','App\Services\Courses')
  @inject('pensumcoursegroups', 'App\Services\Pensumcoursegroups')
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
                <a href="{{ action('PensumController@detail', ['grade_id' => $grade_id]) }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="#" class="btn btn-primary">Modificar</a>
                <div class="media">
                  <div class="media-body">
                    <br>
                    La modificación del pensum afectará a los siguientes ciclos escolares:
                    @foreach ($cycles as $cycle)
                        {{$cycle->name}}
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
            @else
              @if (session('warning'))
                <div class="alert alert-danger">
                  {{ session('warning') }}
                </div>
              @endif
            @endif

            <form id="pensumForm" method="POST"
            action="{{ isset($pensums) ? route('pensum.update') : route('pensum.store') }}"
            enctype="multipart/form-data" aria-label="pensum">
            {{ csrf_field() }}

            <input type="hidden" name="grade_id" value="{{ $grade_id }}" />

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('grade_id','Grado')</th>
                  <th scope="col">@sortablelink('course_id','Curso')</th>
                  <th scope="col">@sortablelink('courseorder','Orden Boleta')</th>
                  <th scope="col">@sortablelink('coursegroup_id','Agrupar')</th>
                </tr>
              </thead>
              <tbody id="myTable">

                @foreach ($pensums as $pensum)
                  <tr>
                    <td data-label="Grado" scope="row">
                      {{ $pensum->grade->name }}
                    </td>

                    <td data-label="Curso">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $pensum->course_id }}" name="course_id[]" {{ $pensum->status == 'ACTIVO' ? 'checked' : 'unchecked' }} />
                        
                        <label class="form-check-label" for="flexCheckChecked">
                          {{ $pensum->course->name }}
                        </label>
                      </div>
                    </td>

                    <td data-label="Orden Boleta" scope="row">
                      <input type="hidden" name="course_id2[]" value="{{ $pensum->course_id }}" />
                      <div class="input-group input-group-sm">
                        <input id="courseorder" type="number" step="any" min="0" max="1000"
                          class="form-control form-control-sm @error('courseorder') is-invalid @enderror" name="courseorder[]"
                          value="{{ $pensum->courseorder ?? '' }}" autocomplete="courseorder" autofocus>
                      </div>

                    </td>
                    
                    <td data-label="Agrupar">

                      <select id="pensumcoursegroup_id" name="pensumcoursegroup_id[]"
                      class="form-control form-control-sm  @error('pensumcoursegroup_id') is-invalid @enderror">
                      @foreach ($pensumcoursegroups->get() as $index => $pensumcoursegroup)
                        <option value="{{ $index }}"
                          {{ old('pensumcoursegroup_id', $pensum->pensumcoursegroup_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $pensumcoursegroup }}
                        </option>
                      @endforeach
                    </select>
                    </td>


                  </tr>

                @endforeach
              </tbody>
            </table>

            <br>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-9">
                <a href="{{ action('PensumController@detail', ['grade_id' => $grade_id]) }}" class="
                  btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                  @if (isset($pensums) && is_object($pensums))
                    Actualizar
                  @else
                    Guardar
                  @endif
                </button>

              </div>
            </div>

          </form>


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
<script>

</script>
@endsection
