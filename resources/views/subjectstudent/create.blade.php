@extends('layouts.app')

@section('content')
@inject('cycles','App\Services\cycles')
@inject('grades','App\Services\grades')

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
                    <select id="cycle_id" name="cycle_id" class="form-control  @error('cycle_id') is-invalid @enderror">
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
                    <select id="grade_id" name="grade_id" class="form-control  @error('grade_id') is-invalid @enderror">
                      @foreach ($grades->get() as $index => $grade)

                        <option value="{{ $index }}"
                          {{ old('grade_id', $subjectstudent->grade_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $grade }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>


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
@endsection
