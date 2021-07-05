@extends('layouts.app')

@section('content')
  @inject('cycles','App\Services\Cycles')

  <div class="container">
    <div class="row justify-content-center ">

      <div class="col-md-8">

        <div class="card-group">
          <div class="card">

            <div class="card-header">
                Establecer Ciclo Actual
            </div>

            <div class="card-body">

              <form id="currentForm" method="POST"
                action="{{ route('cycle.updatecurrent')}}"
                enctype="multipart/form-data" aria-label="cyclecurrent">

                <div class="form-group row">
                  <label for="cycle_id" class="col-md-4 col-form-label text-md-right">Ciclo</label>
                  <div class="col-md-6">
                    <select id="cycle_id" name="cycle_id" class="form-control  @error('cycle_id') is-invalid @enderror">
                      @foreach ($cycles->getAll() as $index => $cycle)

                        <option value="{{ $index }}"
                          {{ old('cycle_id', $cycle->id ?? '') == $index ? 'selected' : '' }}>
                          {{ $cycle }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('cycle.index') }}" class="btn btn-outline-secondary">Cancelar </a>
                    <button type="submit" class="btn btn-primary" id="registro">
                      @if (isset($cycle) && is_object($cycle))
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
