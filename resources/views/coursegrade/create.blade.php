@extends('layouts.app')

@section('content')
  @inject('professors','App\Services\Professors')
  @inject('cycles','App\Services\Cycles')
  @inject('grades','App\Services\Grades')
  @inject('courses','App\Services\Courses')

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
              @if (isset($coursegrade) && is_object($coursegrade))
                Modificar Profesores y Cursos
              @else
                Nueva Profesores y Cursos
              @endif
            </div>

            <div class="card-body">

              <form id="coursegradeForm" method="POST"
                action="{{ isset($coursegrade) ? route('coursegrade.update') : route('coursegrade.store') }}"
                enctype="multipart/form-data" aria-label="Ciclos">
                {{ csrf_field() }}

                @if (isset($coursegrade) && is_object($coursegrade))
                  <input type="hidden" name="id" value="{{ $coursegrade->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="cycle_id" class="col-md-4 col-form-label text-md-right">Ciclo</label>
                  <div class="col-md-6">
                    <select id="cycle_id" name="cycle_id" class="form-control  @error('cycle_id') is-invalid @enderror">
                      @foreach ($cycles->get() as $index => $cycle)

                        <option value="{{ $index }}"
                          {{ old('cycle_id', $coursegrade->cycle_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $cycle }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="grade_id" class="col-md-4 col-form-label text-md-right">Grado</label>
                  <div class="col-md-6">
                    <select id="grade_id" name="grade_id" class="form-control  @error('grade_id') is-invalid @enderror">
                      @foreach ($grades->get() as $index => $grade)

                        <option value="{{ $index }}"
                          {{ old('grade_id', $coursegrade->grade_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $grade }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="employee_id" class="col-md-4 col-form-label text-md-right">Docente</label>
                  <div class="col-md-6">
                    <select id="employee_id" name="employee_id"
                      class="form-control  @error('employee_id') is-invalid @enderror">
                      @foreach ($professors->get() as $index => $employee)

                        <option value="{{ $index }}"
                          {{ old('employee_id', $coursegrade->employee_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $employee }}
                        </option>

                      @endforeach

                    </select>
                  </div>
                </div>

                @if (isset($coursegrade) && is_object($coursegrade))

                <div class="form-group row">
                  <label for="course_id" class="col-md-4 col-form-label text-md-right">Curso</label>
                  <div class="col-md-6">
                    <select id="course" name="course" class="form-control"  @error('course_id') is-invalid @enderror" >
                      @foreach ($courses->get() as $index => $course)
                        <option value="{{ $index }}"
                          {{ old('course_id', $coursegrade->course_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $course }}
                        </option>
                
                      @endforeach
                    </select>
                  </div>
                </div>

                @else

                <div class="form-group row">
                  <label for="course_id" class="col-md-4 col-form-label text-md-right">Curso</label>
                  <div class="col-md-6">
                    <select id="course" name="course[]" class="custom-select" multiple="multiple">
                      @foreach ($courses->get() as $index => $course)
                        <option value="{{ $index }}"
                          {{ old('course_id', $coursegrade->course_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $course }}
                        </option>
                
                      @endforeach
                    </select>
                  </div>
                </div>
                @endif


                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('coursegrade.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                      @if (isset($coursegrade) && is_object($coursegrade))
                        Actualizar
                      @else
                        Guardar
                      @endif
                    </button>
                    @if (isset($coursegrade) && is_object($coursegrade))
                    <a href="{{action('CoursegradeController@destroy',['id' => $coursegrade->id])}}" class="btn btn-danger">Eliminar</a>
                    @endif

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

@endsection
