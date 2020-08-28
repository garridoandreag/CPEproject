@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center ">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            @if (isset($course) && is_object($course))
              MODIFICAR ESTUDIANTE
            @else
              NUEVO ESTUDIANTE
            @endif
          </div>
          <div class="card-body">
            <form action="
                {{ isset($course) ? action('CourseController@update') : action('CourseController@store') }}"
              enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}

              @if (isset($course) && is_object($course))
                <input type="hidden" class="form-control" name="id" value="{{ $course->id }}" /><br>
              @endif

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">FECHA DE
                  Nombre</label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ $course->name ?? '' }}" required autocomplete="name" autofocus>

                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Guardar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
