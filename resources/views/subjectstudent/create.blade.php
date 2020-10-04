@extends('layouts.app')

@section('content')
@inject('cycles','App\Services\cycles')

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

                <div class="form-group row">
                  <label for="cycle_id" class="col-md-4 col-form-label text-md-right">Ciclo</label>
                  <div class="col-md-6">
                    <select id="cycle_id" name="cycle_id" class="form-control  @error('school_id') is-invalid @enderror">
                      @foreach ($cycles->get() as $index => $cycle)

                        <option value="{{ $index }}"
                          {{ old('cycle_id', $subjectstudent->cycle_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $cycle }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>



                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('subjectstudent.index') }}" class="btn btn-outline-secondary">Cancelar</a>

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
