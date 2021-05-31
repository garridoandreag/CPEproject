@extends('layouts.app')

@section('content')
@inject('cycles','App\Services\cycles')
@inject('grades','App\Services\grades')
@inject('courses','App\Services\courses')
@inject('coursegrades','App\Services\coursegrades')

  <div class="container">
    <div class="row justify-content-center ">

      <div class="col-md-8">
        @if (session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif
        <div class="card-group">
          <div class="card">

            <div class="card-header">
              @if (isset($subjectstudent) && is_object($subjectstudent))
                Modificar Inscripción
              @else
                Nueva Inscripción
              @endif
            </div>

            <div class="card-body">

              <form id="gradeForm" method="POST"
                action="{{ isset($subjectstudent) ? route('subjectstudent.update') : route('subjectstudent.store') }}"
                enctype="multipart/form-data" aria-label="Grados">
                {{ csrf_field() }}

                @if (isset($subjectstudent) && is_object($subjectstudent))
                  <input type="hidden" name="id" value="{{ $subjectstudent->id }}" /><br>
                @endif

                <input type="hidden" name="student_id" value="{{ $student_id }}" /><br>
                <div class="form-group row">
                  <label for="cycle_id" class="col-md-4 col-form-label text-md-right">Ciclo</label>
                  <div class="col-md-6">
                    <select id="cycle_id" name="cycle_id" class="form-control  @error('cycle_id') is-invalid @enderror" 
                    {{ isset($subjectstudent) ? 'disabled' : '' }}>
                      @foreach ($cycles->get() as $index => $cycle)

                        <option value="{{ $index }}"
                          {{ old('cycle_id', $subjectstudent->cycle_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $cycle }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="grade_id" class="col-md-4 col-form-label text-md-right">Grado</label>
                  <div class="col-md-6">
                    <select id="grade_id" name="grade_id" class="form-control  @error('grade_id') is-invalid @enderror" 
                    {{ isset($subjectstudent) ? 'disabled' : '' }}>
                      @foreach ($grades->get() as $index => $grade)

                        <option value="{{ $index }}"
                          {{ old('grade_id', $subjectstudent->grade_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $grade }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                @if (isset($subjectstudent))
                <table class="table table-bordered" id="myTable">
                  <thead>
                      <tr>
                          <th>Curso</th>
                          <th><a href="#" class="addRow" id="addRow">
                                  <i class="fas fa-plus-circle"></i>
                              </a>
                          </th>
                      </tr>
                  </thead>
                  <tbody>

                          @foreach ($subjects as $subject)
                              <tr id="1">
                                  <td data-label="Asignatura" scope="row">
                                    {{$subject->coursegrade->course->name}}
   
                                  </td>
                                  <td>
                                      @if (isset($subject) && is_object($subject))
                                          <a href="{{ action('SubjectstudentController@destroycourse', ['student_id' => $subject->student_id, 'cycle_id' => $subject->cycle_id, 'grade_id' => $subject->grade_id, 'course_id' => $subject->course_id]) }}"
                                              class="btn btn-danger">Quitar curso</a>
                                      @endif
                                  </td>
                              </tr>
                          @endforeach
                     
                  </tbody>
              </table>
              @endif

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ action('SubjectstudentController@inscription', ['student_id' => $student_id]) }}" class="btn btn-outline-secondary">Cancelar</a>
                    
                    <button type="submit" class="btn btn-primary">
                      @if (isset($subjectstudent) && is_object($subjectstudent))
                        Actualizar
                      @else
                        Guardar
                      @endif
                    </button>

                  </div>
                </div>
                <br />
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script>
    var row = 1;
    $('.addRow').on('click', function() {
        addRow();
    });

    function addRow() {
        row++;
        var tr =
            `<tr id="${row}">
          <td data-label="Asignatura" scope="row">
                        <div class="input-group input-group-sm">
                          <select id="course_id" name="course_id[]" class="form-control ">
                            @foreach ($courses->get() as $index => $course)
                            
                                <option value="{{ $index }}"
                                    {{ old('course_id', $subject->coursegrade->course->id ?? '') == $index ? 'selected' : '' }}>
                                    {{ $course }}
                                </option>
                            
                            @endforeach
                          </select>
                        </div>
                      </td>

              <td><button type="button" onclick="removeRow(${row})" class="remove">
                  <i class="fas fa-minus-circle"></i>
                  </button>
              </td>
            </tr>`;
        $('tbody').append(tr);
    };

    function removeRow(id) {
        $(`#${id}`).remove();
    }

</script>
@endsection
