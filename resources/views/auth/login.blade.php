@extends('layouts.unauthenticated')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-5">
                <br>
                <br>
                <div class="card">
                    <div class="card-header" style="text-align: center">¡Bienvenido al Colegio Pequeñas Estrellas!</div>

                    <div class="card-body">
                        @include('includes.logo_guest')
                        <br>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">

                                <div class="col-md-12 input-group-lg">
                                    <input id="email" type="text" placeholder="Usuario ID"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 input-group-lg">
                                    <input id="password" type="password" placeholder="Contraseña"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Recuerdame') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (session('error'))
                                <strong style="color: red">{{ session('error') }}</strong>
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary  btn-lg btn-block">
                                        {{ __('Ingresar') }}
                                    </button>
                                    <br>



                                    <!--      if (Route::has('password.request'))
                                                    <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                                                      { __('¿Olvidaste tu contraseña?') }}
                                                    </a>
                                                  endif
                                                  -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
