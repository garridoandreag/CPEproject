@extends('layouts.app')

@section('content')
  @inject('sections','App\Services\Sections')

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
            <div class="card-header">DETALLES DEL GRADO</div>
            <div class="card-body">

              <form id="gradeForm" method="POST"
                action="{{ isset($grade) ? route('grade.update') : route('grade.store') }}" enctype="multipart/form-data"
                aria-label="Grados">
                {{ csrf_field() }}


                @if (isset($grade) && is_object($grade))
                  <input type="hidden" name="id" value="{{ $grade->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                      value="{{ $grade->name ?? '' }}" required autocomplete="name" autofocus readonly>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="section" class="col-md-4 col-form-label text-md-right">Sección</label>
                  <div class="col-md-6">
                    <select id="section" name="section" class="form-control  @error('section') is-invalid @enderror"
                      readonly>
                      @foreach ($sections->get() as $section)

                        <option value="{{ $section }}"
                          {{ old('section', $grade->section ?? '') == $section ? 'selected' : '' }}>
                          {{ $section }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>
                
                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ action('GradeController@index') }}" class="btn btn-outline-primary">Regresar </a>
                    <a href="{{action('GradeController@edit',['id' => $grade->id])}}" class="btn btn-primary">Editar</a>
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
