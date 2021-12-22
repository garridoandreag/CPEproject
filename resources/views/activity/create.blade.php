@extends('layouts.app')

@section('content')
  @inject('units','App\Services\Units')
  @inject('courseprofessors','App\Services\Courseprofessors')
  @inject('types','App\Services\Types')

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
                aria-label="actividades">
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
                  <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                  <div class="col-md-6">
                    <textarea class="form-control"
                      name="description" value="{{ $activity->description ?? '' }}" required >{{ $activity->description ?? '' }}</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="score" class="col-md-4 col-form-label text-md-right">Puntos</label>

                  <div class="col-md-6">
                    <input id="score" type="number" step="any" min="0" class="form-control @error('score') is-invalid @enderror" name="score"
                      value="{{ $activity->score ?? '' }}" required autocomplete="score" autofocus>

                    @error('score')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="type" class="col-md-4 col-form-label text-md-right">Tipo de actividad</label>
                  <div class="col-md-6">
                    <select id="type" name="type" class="form-control  @error('type') is-invalid @enderror">
                      @foreach ($types->get() as $type)

                        <option value="{{ $type }}"
                          {{ old('type', $activity->type ?? '') == $type ? 'selected' : '' }}>
                          {{ $type }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="unit_id" class="col-md-4 col-form-label text-md-right">Unidad</label>
                  <div class="col-md-6">
                    <select id="unit_id" name="unit_id"
                      class="form-control  @error('unit_id') is-invalid @enderror" {{ isset($activity) ? 'readonly' : '' }}>
                      @foreach ($units->get() as $index => $unit)

                        <option value="{{ $index }}"
                          {{ old('unit_id', $activity->unit_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $unit }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="coursegrade_id" class="col-md-4 col-form-label text-md-right">Curso</label>
                  <div class="col-md-6">
                    <select id="coursegrade_id" name="coursegrade_id"
                      class="form-control  @error('coursegrade_id') is-invalid @enderror" {{ isset($activity) ? 'readonly' : '' }}>
                      @foreach ($courseprofessors->get($employee_id,$coursegrade_id ?? '') as $index => $courseprofessor)

                        <option value="{{ $index }}"
                          {{ old('coursegrade_id', $activity->coursegrade_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $courseprofessor }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="delivery_date" class="col-md-4 col-form-label text-md-right">Fecha de Entrega</label>
                  <div class="col-md-6">
                    <input id="delivery_date" type="date" class="form-control @error('delivery_date') is-invalid @enderror"
                      name="delivery_date" value="{{ $activity->delivery_date ?? '' }}" required autocomplete="delivery_date"
                      autofocus>

                    @error('delivery_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('courseprofessor.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                      @if (isset($activity) && is_object($activity))
                        Actualizar
                      @else
                        Guardar
                      @endif
                    </button>
                    @if(isset($activity) && is_object($activity))
                    <a href="{{ action('ActivityController@destroy',['id' => $activity->id], ['method' => 'DELETE'])  }}"
                    class="btn btn-danger">Eliminar</a>
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
