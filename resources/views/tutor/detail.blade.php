@extends('layouts.app')

@section('content')
  @inject('subdivisions','App\Services\Subdivisions')



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
            @if (isset($tutor) && is_object($tutor))
              <div class="card-header">MODIFICAR PADRE O ENCARGADO</div>
            @else
              <div class="card-header">NUEVO PADRE O ENCARGADO</div>
            @endif

            <div class="card-body">

              <form id="tutorForm" method="POST"
                action="{{ isset($tutor) ? route('tutor.update') : route('tutor.store') }}" enctype="multipart/form-data"
                aria-label="Configuración de mi cuenta">
                {{ csrf_field() }}


                @if (isset($tutor) && is_object($tutor))
                  <input type="hidden" name="id" value="{{ $tutor->id }}" /><br>
                @endif


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="form_personal" data-toggle="tab" href="#personal" role="tab"
                      aria-controls="personal" aria-selected="true">PERSONAL</a>
                  </li>
    
                </ul>


                <div class="tab-content" id="myTabContent" style="margin-top:16px;">
                  <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="form_personal">


                    <div class="form-group row">
                      <label for="names" class="col-md-4 col-form-label text-md-right">NOMBRES</label>

                      <div class="col-md-6">
                        <input id="names" type="text" class="form-control @error('names') is-invalid @enderror"
                          name="names" value="{{ $tutor->person->names ?? '' }}" required autocomplete="names" autofocus readonly>

                        @error('names')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="first_name" class="col-md-4 col-form-label text-md-right">PRIMER
                        APELLIDO</label>

                      <div class="col-md-6">
                        <input id="first_surname" type="text"
                          class="form-control @error('first_surname') is-invalid @enderror" name="first_surname"
                          value="{{ $tutor->person->first_surname ?? '' }}" required autocomplete="first_surname"
                          autofocus readonly>

                        @error('first_surname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="second_surname" class="col-md-4 col-form-label text-md-right">SEGUNDO APELLIDO</label>

                      <div class="col-md-6">
                        <input id="second_surname" type="text"
                          class="form-control @error('second_surname') is-invalid @enderror" name="second_surname"
                          value="{{ $tutor->person->second_surname ?? '' }}" required autocomplete="second_surname"
                          autofocus readonly>

                        @error('second_surname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="phone_number" class="col-md-4 col-form-label text-md-right">TELEFONO
                        DE CASA</label>

                      <div class="col-md-6">
                        <input id="phone_number" type="text"
                          class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                          value="{{ $tutor->person->phone_number ?? '' }}" required autocomplete="phone_number" autofocus readonly>

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row">
                        <label for="cellphone_number" class="col-md-4 col-form-label text-md-right">TELEFONO</label>
  
                        <div class="col-md-6">
                          <input id="cellphone_number" type="text"
                            class="form-control @error('cellphone_number') is-invalid @enderror" name="cellphone_number"
                            value="{{ $tutor->person->cellphone_number ?? '' }}" required autocomplete="cellphone_number" autofocus readonly>
  
                          @error('cellphone_number')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                    <div class="form-group row">
                      <label for="subdivision_code" class="col-md-4 col-form-label text-md-right">DEPARTAMENTO</label>
                      <div class="col-md-6">
                        <select id="subdivision_code" name="subdivision_code"
                          class="form-control  @error('subdivision_code') is-invalid @enderror" readonly >
                          @foreach ($subdivisions->get() as $index => $subdivision)

                            <option value="{{ $index }}"
                              {{ old('subdivision_code', $tutor->person->subdivision_code ?? '') == $index ? 'selected' : '' }}>
                              {{ $subdivision }}
                            </option>

                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="home_address" class="col-md-4 col-form-label text-md-right">DIRECCIÓN DE CASA</label>

                      <div class="col-md-6">
                        <input id="home_address" type="text"
                          class="form-control @error('home_address') is-invalid @enderror" name="home_address"
                          value="{{ $tutor->person->home_address ?? '' }}" required autocomplete="home_address" autofocus readonly>

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="dpi" class="col-md-4 col-form-label text-md-right">DPI</label>

                      <div class="col-md-6">
                        <input id="dpi" type="text" class="form-control @error('dpi') is-invalid @enderror" name="dpi"
                          value="{{ $tutor->dpi ?? '' }}" required autocomplete="dpi" autofocus readonly>

                        @error('dpi')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="occupation" class="col-md-4 col-form-label text-md-right">OCUPACIÓN</label>

                      <div class="col-md-6">
                        <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror"
                          name="occupation" value="{{ $tutor->occupation ?? '' }}" required autocomplete="occupation"
                          autofocus readonly>

                        @error('occupation')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>



                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                          Guardar
                        </button>
                      </div>
                    </div>
                    <br />
                  </div>


                  <div class="tab-pane fade" id="academico" role="tabpanel" aria-labelledby="form_personal">







                  </div>
                </div>


              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>




  </script>
@endsection
