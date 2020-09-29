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
              Detalle del Aviso 
            </div>

            <div class="card-body">

              <form id="announcementForm" method="POST"
                action="{{ isset($announcement) ? route('announcement.update') : route('announcement.store') }}"
                enctype="multipart/form-data" aria-label="Ciclos">
                {{ csrf_field() }}

                @if (isset($announcement) && is_object($announcement))
                  <input type="hidden" name="id" value="{{ $announcement->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="title" class="col-md-4 col-form-label text-md-right">Título</label>

                  <div class="col-md-6">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                      value="{{ $announcement->title ?? '' }}" required autocomplete="title" autofocus readonly>

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
                    <textarea id="description" type="text" rows="10"
                      class="form-control  @error('description') is-invalid @enderror" name="description" readonly>{{ $announcement->description ?? '' }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cycle_id" class="col-md-4 col-form-label text-md-right">Ciclo</label>
                  <div class="col-md-6">
                    <select id="cycle_id" name="cycle_id" class="form-control  @error('school_id') is-invalid @enderror" readonly> 
                      @foreach ($cycles->get() as $index => $cycle)

                        <option value="{{ $index }}"
                          {{ old('cycle_id', $announcement->cycle_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $cycle }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="start_time" class="col-md-4 col-form-label text-md-right">Iniciar</label>
                  <div class="col-md-6">
                    <input id="start_time" type="datetime-local"
                      class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                      value="{{ $announcement->start_time ?? '' }}" required autocomplete="start_time" autofocus readonly>

                    @error('start_time')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="end_time" class="col-md-4 col-form-label text-md-right">Finalizar</label>
                  <div class="col-md-6">
                    <input id="end_time" type="datetime-local"
                      class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                      value="{{ $announcement->end_time ?? '' }}" required autocomplete="end_time" autofocus readonly>

                    @error('end_time')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('announcement.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <a href="{{action('AnnouncementController@edit',['id' => $announcement->id])}}" class="btn btn-primary">Editar</a>
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