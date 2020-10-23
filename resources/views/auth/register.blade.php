@extends('layouts.app')
@section('content')
@inject('roles','App\Services\roles')
<style>
    .select-search {
      width: 100%;
    }

  </style>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>

  <div class="container" id="test">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Registro') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="form-group row">
                <label for="person_id" class="col-md-4 col-form-label text-md-right">Person a asignar </label>
                <div class="col-md-6">
                  <select name="person_id" class="select-search" id="select-person">
                  </select>

                  @error('person_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="role_id" class="col-md-4 col-form-label text-md-right">Rol</label>
                <div class="col-md-6">
                  <select id="role_id" name="role_id" class="form-control  @error('role_id') is-invalid @enderror">
                    @foreach ($roles->get() as $index => $role)

                      <option value="{{ $index }}"
                        {{ old('role_id', $user->role_id ?? '') == $index ? 'selected' : '' }}>
                        {{ $role }}
                      </option>

                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre para mostrar</label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Usuario ID</label>

                <div class="col-md-6">
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>

                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                  <button type="submit" class="btn btn-primary">
                    Registrar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
          $(document).ready(function() {
      const select = $('#select-person');
      select.select2({
 
        ajax: {
          type: 'POST',
          url: '/search-person',
          data: function(params) {
            return {
              name: params.term,
            };
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          processResults: function(data) {
            return {
              results: data
            };
          }
        }
      });
    });
</script>
@endsection
