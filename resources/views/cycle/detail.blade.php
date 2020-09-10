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
              Detalle del ciclo
            </div>

            <div class="card-body">

              <form id="gradeForm" method="POST"
                action="{{ isset($cycle) ? route('cycle.update') : route('cycle.store') }}" enctype="multipart/form-data"
                aria-label="Ciclos">
                {{ csrf_field() }}

                @if (isset($cycle) && is_object($cycle))
                  <input type="hidden" name="id" value="{{ $cycle->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                      value="{{ $cycle->name ?? '' }}" required autocomplete="name" autofocus readonly>

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
                      class="form-control  @error('school_id') is-invalid @enderror" readonly >
                      @foreach ($schools->get() as $index => $school)

                        <option value="{{ $index }}"
                          {{ old('school_id', $cycle->school_id ?? '') == $index ? 'selected' : '' }}>
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
                      name="start_date" value="{{ $cycle->start_date ?? '' }}" required autocomplete="start_date"
                      autofocus readonly>

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
                      name="end_date" value="{{ $cycle->end_date ?? '' }}" required autocomplete="end_date" autofocus readonly>

                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('cycle.index') }}" class="btn btn-outline-primary">Regresar</a>
                    <a href="{{action('CycleController@edit',['id' => $cycle->id])}}" class="btn btn-primary">Editar</a>
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
