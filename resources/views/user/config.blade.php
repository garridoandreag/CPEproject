@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if (session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif

        <div class="card">
          <div class="card-header">Configuración de mi cuenta</div>
          <div class="card-body">
            <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data"
              aria-label="Configuración de mi cuenta">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre para mostrar') }}</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>
                <div class="col-md-6">
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ Auth::user()->email }}" required autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Foto Perfil') }}</label>
                <div class="col-md-6">
                  @include('includes.picture_profile')
                  <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror"
                    name="picture" value="{{ Auth::user()->person->picture ?? '' }}">
                  @error('picture')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <a href="{{ route('home') }}" " class="btn btn-outline-secondary">Cancelar</a>
                  <button type="submit" class="btn btn-primary">
                    Actualizar
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
