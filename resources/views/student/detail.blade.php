@extends('layouts.app')

@section('content')
  @inject('grades','App\Services\Grades')

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
            <div class="card-header">DETALLES DEL ESTUDIANTE</div>

            <div class="card-body">

              <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data"
                aria-label="Configuración de mi cuenta">
                @csrf


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="form_personal" data-toggle="tab" href="#personal" role="tab"
                      aria-controls="personal" aria-selected="true">PERSONAL</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#academico" role="tab"
                      aria-controls="academico" aria-selected="false">ACADEMICO</a>
                  </li>
                </ul>


                <div class="tab-content" id="myTabContent" style="margin-top:16px;">
                  <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="form_personal">

                    <div class="form-group row">
                      <label for="favorite_name" class="col-md-4 col-form-label text-md-right">CÓMO DESEA SER
                        LLAMADO</label>

                      <div class="col-md-6">
                        <input id="favorite_name" type="text"
                          class="form-control @error('favorite_name') is-invalid @enderror" name="favorite_name"
                          value="{{ $student->person->favorite_name }}" required autocomplete="favorite_name" autofocus
                          readonly>

                        @error('favorite_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="names" class="col-md-4 col-form-label text-md-right">NOMBRES</label>

                      <div class="col-md-6">
                        <input id="names" type="text" class="form-control @error('names') is-invalid @enderror"
                          name="names" value="{{ $student->person->names }}" required autocomplete="names" autofocus
                          readonly>

                        @error('names')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="first_name" class="col-md-4 col-form-label text-md-right">PRIMER APELLIDO</label>

                      <div class="col-md-6">
                        <input id="first_surname" type="text"
                          class="form-control @error('first_surname') is-invalid @enderror" name="first_surname"
                          value="{{ $student->person->first_surname }}" required autocomplete="first_surname" autofocus
                          readonly>

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
                          value="{{ $student->person->second_surname }}" required autocomplete="second_surname" autofocus
                          readonly>

                        @error('second_surname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="phone_number" class="col-md-4 col-form-label text-md-right">TELEFONO DE CASA</label>

                      <div class="col-md-6">
                        <input id="phone_number" type="text"
                          class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                          value="{{ $student->person->phone_number }}" required autocomplete="phone_number" autofocus
                          readonly>

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="birthday" class="col-md-4 col-form-label text-md-right">FECHA DE NACIMIENTO</label>

                      <div class="col-md-6">
                        <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror"
                          name="birthday" value="{{ $student->birthday }}" required autocomplete="birthday" autofocus
                          readonly>

                        @error('birthday')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="gender_id" class="col-md-4 col-form-label text-md-right">GÉNERO</label>

                      <div class="col-md-6">

                        @switch($student->person->gender_id)
                          @case('F')
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender_id" id="FEMENINO" value="F" checked
                              readonly>
                            <label class="form-check-label" for="FEMENINO">
                              FEMENINO
                            </label>
                          </div>
                          @break
                          @case('M')
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender_id" id="MASCULINO" value="M" checked
                              readonly>
                            <label class="form-check-label" for="MASCULINO">
                              MASCULINO
                            </label>
                          </div>
                          @break
                        @endswitch

                        @error('gender_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('FOTO') }}</label>

                      <div class="col-md-6">

                        @if ($student->person->picture)

                          <div class="container-profile">
                            <img src="{{ route('student.picture', ['filename' => $student->person->picture]) }}"
                              class="picture_profile" />
                          </div>

                        @endif

                        @error('picture')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">

                        <a href="{{ action('StudentController@index') }}" class="btn btn-outline-primary">Regresar </a>
                        <a class="btn btn-outline-primary" id="profile-tab" data-toggle="tab" href="#academico" role="tab"
                          aria-controls="academico" aria-selected="false">Siguiente </a>
                        <a href="{{ action('StudentController@edit', ['id' => $student->id]) }}"
                          class="btn btn-primary">Editar</a>

                      </div>
                    </div>



                    <br />
                  </div>



                  <div class="tab-pane fade" id="academico" role="tabpanel" aria-labelledby="form_personal">

                    <div class="form-group row">
                      <label for="grade" class="col-md-4 col-form-label text-md-right">GRADO</label>
                      <div class="col-md-6">
                        <select id="grade" name="grade_id" class="form-control  @error('grade_id') is-invalid @enderror"
                          readonly>
                          @foreach ($grades->get() as $index => $grade)

                            <option value="{{ $index }}"
                              {{ old('grade_id', $student->grade_id ?? '') == $index ? 'selected' : '' }}>
                              {{ $grade }}
                            </option>

                          @endforeach
                        </select>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="second_surname" class="col-md-4 col-form-label text-md-right">CÓDIGO ESTADÍSTICO</label>

                      <div class="col-md-6">
                        <input id="student_code" type="text"
                          class="form-control @error('student_code') is-invalid @enderror" name="student_code"
                          value="{{ $student->student_code ?? '' }}" required autocomplete="student_code" readonly>

                        @error('student_code')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <br />




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
