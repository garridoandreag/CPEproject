@extends('layouts.app')

@section('content')
  @inject('schools','App\Services\Schools')

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
              @if (isset($activity) && is_object($activity))
                Modificar Actividad
              @else
                Nuevo Actividad
              @endif
            </div>

            <div class="card-body">

              <form id="gradeForm" method="POST"
                action="{{ isset($activity) ? route('activity.update') : route('activity.store') }}" enctype="multipart/form-data"
                aria-label="Actividadess">
                {{ csrf_field() }}

                @if (isset($activity) && is_object($activity))
                  <input type="hidden" name="id" value="{{ $activity->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                      value="{{ $activity->name ?? '' }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="school_id" class="col-md-4 col-form-label text-md-right">Colegio</label>
                  <div class="col-md-6">
                    <select id="school_id" name="school_id"
                      class="form-control  @error('school_id') is-invalid @enderror">
                      @foreach ($schools->get() as $index => $school)

                        <option value="{{ $index }}"
                          {{ old('school_id', $activity->school_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $school }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="start_date" class="col-md-4 col-form-label text-md-right">Fecha de Inicio</label>
                  <div class="col-md-6">
                    <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror"
                      name="start_date" value="{{ $activity->start_date ?? '' }}" required autocomplete="start_date"
                      autofocus>

                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="end_date" class="col-md-4 col-form-label text-md-right">Fecha de fin</label>
                  <div class="col-md-6">
                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror"
                      name="end_date" value="{{ $activity->end_date ?? '' }}" required autocomplete="end_date" autofocus>

                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('activity.index') }}" class="btn btn-outline-primary">Regresar </a>
                    <button type="submit" class="btn btn-primary">
                      @if (isset($activity) && is_object($activity))
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
