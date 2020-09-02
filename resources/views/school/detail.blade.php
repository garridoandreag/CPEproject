@extends('layouts.app')

@section('content')

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
            @if (isset($school) && is_object($school))
              <div class="card-header">DETALLES COLEGIO</div>
            @else
              <div class="card-header">DETALLES COLEGIO</div>
            @endif

            <div class="card-body">
              <form id="schoolForm" method="POST"
                action="{{ isset($school) ? route('school.update') : route('school.store') }}" enctype="multipart/form-data"
                aria-label="Colegio">
                {{ csrf_field() }}

                @if (isset($school) && is_object($school))
                  <input type="hidden" name="id" value="{{ $school->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                      value="{{ $school->name ?? '' }}" autocomplete="name" autofocus readonly>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="phone_number" class="col-md-4 col-form-label text-md-right">Teléfono</label>
                  <div class="col-md-6">
                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                      value="{{ $school->phone_number ?? '' }}" required autocomplete="phone_number" autofocus  readonly>
                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cellphone_number" class="col-md-4 col-form-label text-md-right">Teléfono 2</label>
                  <div class="col-md-6">
                    <input id="cellphone_number" type="text" class="form-control @error('cellphone_number') is-invalid @enderror" name="cellphone_number"
                      value="{{ $school->cellphone_number ?? '' }}" required autocomplete="cellphone_number" autofocus  readonly>
                    @error('cellphone_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="address" class="col-md-4 col-form-label text-md-right">Dirección</label>
                  <div class="col-md-6">
                    <input id="address" class="form-control @error('address') is-invalid @enderror" name="address"
                      value="{{ $school->address ?? '' }}" required autocomplete="address" autofocus  readonly>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="vision" class="col-md-4 col-form-label text-md-right">Vision</label>
                  <div class="col-md-6">
                    <textarea id="vision" rows="5" class="form-control  @error('vision') is-invalid @enderror" name="vision"
                      value="{{ $school->vision ?? '' }}" autofocus readonly></textarea>
                    @error('vision')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="mision" class="col-md-4 col-form-label text-md-right">Mision</label>
                  <div class="col-md-6">
                    <textarea id="mision" rows="5" class="form-control  @error('mision') is-invalid @enderror" name="mision"
                      value="{{ $school->mision ?? '' }}" autofocus  readonly ></textarea>
                    @error('mision')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="history" class="col-md-4 col-form-label text-md-right">Historia Breve</label>
                  <div class="col-md-6">
                    <textarea id="history" type="text" rows="8" class="form-control  @error('history') is-invalid @enderror" name="history"
                      value="{{ $school->history ?? '' }}" autofocus  readonly></textarea>
                    @error('history')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="facebook_url" class="col-md-4 col-form-label text-md-right">Facebook (URL) </label>
                  <div class="col-md-6">
                    <input id="facebook_url" type="text" class="form-control @error('facebook_url') is-invalid @enderror" name="facebook_url"
                      value="{{ $school->facebook_url ?? '' }}" autocomplete="facebook_url" autofocus  readonly>
                    @error('facebook_url')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label>
                  <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                      name="email" value="{{ $school->email ?? '' }}" autocomplete="email" autofocus readonly>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('school.index') }}" class="btn btn-outline-primary">Regresar </a>
                    <a href="{{ action('SchoolController@edit', ['id' => $school->id]) }}" class="btn btn-primary">Editar </a>
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
