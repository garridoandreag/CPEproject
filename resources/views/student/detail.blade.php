@extends('layouts.app')

@section('content')
  @inject('grades','App\Services\Grades')
  @inject('genders','App\Services\Genders')
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
            <div class="card-header">
              @if (isset($student) && is_object($student))
                Modificar Estudiante
              @else
                Nuevo Estudiante
              @endif
            </div>

            <div class="card-body">

              <form id="studentForm" method="POST" action="
                                  {{ isset($student) ? route('student.update') : route('student.store') }}"
                enctype="multipart/form-data" aria-label="Configuración de mi cuenta">
                {{ csrf_field() }}


                @if (isset($student) && is_object($student))
                  <input type="hidden" name="id" value="{{ $student->id }}" /><br>
                @endif


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" id="form_personal" data-toggle="tab" href="#personal" role="tab"
                      aria-controls="personal" aria-selected="false">Personal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="form_personal" data-toggle="tab" href="#academico" role="tab"
                      aria-controls="academico" aria-selected="false">Academico</a>
                  </li>
                </ul>


                <div class="tab-content" id="myTabContent" style="margin-top:16px;">
                  <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="form_personal">

                    <div class="form-group row">
                      <label for="favorite_name" class="col-md-4 col-form-label text-md-right">Cómo desea ser
                        llamado</label>

                      <div class="col-md-6">
                        <input id="favorite_name" type="text"
                          class="form-control @error('favorite_name') is-invalid @enderror" name="favorite_name"
                          value="{{ $student->person->favorite_name ?? '' }}" required autocomplete="favorite_name"
                          autofocus readonly>

                        @error('favorite_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="names" class="col-md-4 col-form-label text-md-right">Nombre</label>

                      <div class="col-md-6">
                        <input id="names" type="text" class="form-control @error('names') is-invalid @enderror"
                          name="names" value="{{ $student->person->names ?? '' }}" required autocomplete="names"
                          autofocus readonly>
                        @error('names')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="first_name" class="col-md-4 col-form-label text-md-right">Primer apellido</label>
                      <div class="col-md-6">
                        <input id="first_surname" type="text"
                          class="form-control @error('first_surname') is-invalid @enderror" name="first_surname"
                          value="{{ $student->person->first_surname ?? '' }}" required autocomplete="first_surname"
                          autofocus readonly>
                        @error('first_surname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="second_surname" class="col-md-4 col-form-label text-md-right">Segundo apellido</label>
                      <div class="col-md-6">
                        <input id="second_surname" type="text"
                          class="form-control @error('second_surname') is-invalid @enderror" name="second_surname"
                          value="{{ $student->person->second_surname ?? '' }}" required autocomplete="second_surname"
                          autofocus readonly>
                        @error('second_surname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="phone_number" class="col-md-4 col-form-label text-md-right">Teléfono de casa</label>
                      <div class="col-md-6">
                        <input id="phone_number" type="text"
                          class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                          value="{{ $student->person->phone_number ?? '' }}" required autocomplete="phone_number"
                          autofocus readonly>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="subdivision_code" class="col-md-4 col-form-label text-md-right">Departamento</label>
                      <div class="col-md-6">
                        <select id="subdivision_code" name="subdivision_code"
                          class="form-control  @error('subdivision_code') is-invalid @enderror" disabled>
                          @foreach ($subdivisions->get() as $index => $subdivision)
                            <option value="{{ $index }}"
                              {{ old('subdivision_code', $student->person->subdivision_code ?? '') == $index ? 'selected' : '' }}>
                              {{ $subdivision }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="home_address" class="col-md-4 col-form-label text-md-right">Dirección de
                        domicilio</label>
                      <div class="col-md-6">
                        <input id="home_address" type="text"
                          class="form-control @error('home_address') is-invalid @enderror" name="home_address"
                          value="{{ $student->person->home_address ?? '' }}" required autocomplete="home_address"
                          autofocus readonly>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="birthday" class="col-md-4 col-form-label text-md-right">Fecha de nacimiento</label>

                      <div class="col-md-6">
                        <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror"
                          name="birthday" value="{{ $student->birthday ?? '' }}" required autocomplete="birthday"
                          autofocus readonly>

                        @error('birthday')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="gender_id" class="col-md-4 col-form-label text-md-right">Género</label>
                      <div class="col-md-6">
                        <select id="gender_id" name="gender_id"
                          class="form-control  @error('gender_id') is-invalid @enderror" disabled>
                          @foreach ($genders->get() as $index => $gender)

                            <option value="{{ $index }}"
                              {{ old('gender_id', $student->person->gender_id ?? '') == $index ? 'selected' : '' }}>
                              {{ $gender }}
                            </option>

                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                      <div class="col-md-6">

                        @if ($student->person->picture ?? '')
                          <div class="container-profile">
                            <img src="{{ route('student.picture', ['filename' => $student->person->picture]) }}"
                              class="picture_profile" />
                          </div>
                        @endif

                        <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror"
                          name="picture" disabled>

                        @error('picture')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <a href="{{ route('student.index') }}" class="btn btn-outline-primary">Regresar </a>
                        <a href="#academico" data-toggle="tab" class="btn btn-outline-primary">Siguiente</a>
                        <a href="{{action('StudentController@edit',['id' => $student->id])}}" class="btn btn-primary">Editar</a>
                      </div>
                    </div>
                    <br />
                  </div>

                  <div class="tab-pane fade" id="academico" role="tabpanel" aria-labelledby="form_personal">

                    <div class="form-group row">
                      <label for="grade" class="col-md-4 col-form-label text-md-right">Grado</label>
                      <div class="col-md-6">
                        <select id="grade" name="grade_id" class="form-control  @error('grade_id') is-invalid @enderror" disabled>
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
                      <label for="second_surname" class="col-md-4 col-form-label text-md-right">Código Estadístico</label>

                      <div class="col-md-6">
                        <input id="student_code" type="text"
                          class="form-control @error('student_code') is-invalid @enderror" name="student_code"
                          value="{{ $student->student_code ?? '' }}" required autocomplete="student_code" autofocus readonly>

                        @error('student_code')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <br>
                    <p class="text-center"><b>
                      PERSONAS AUTORIZADAS PARA RECOGER AL ESTUDIANTE:
                    </b></p>

                    <table class="table table-bordered" id="myTable">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Parentesco</th>
                          <th>Teléfono</th>
                          <th><a href="#" class="addRow" id="addRow" disabled>
                              <i class="fas fa-plus-circle"></i>
                            </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (isset($student->caregiver))
                          @foreach ($student->caregiver as $caregiver)
                            <tr id="1">
                              <td>
                                <input id="name_caregiver" type="text"
                                  class="form-control form-control-sm @error('name_caregiver') is-invalid @enderror"
                                  name="name_caregiver[]" value="{{ $caregiver->name ?? '' }}"
                                  autocomplete="name_caregiver" autofocus readonly>
                              </td>
                              <td>
                                <input id="surname_caregiver" type="text"
                                  class="form-control form-control-sm @error('surname_caregiver') is-invalid @enderror"
                                  name="surname_caregiver[]" value="{{ $caregiver->surname ?? '' }}"
                                  autocomplete="surname_caregiver" autofocus readonly>
                              </td>
                              <td>
                                <input id="relationship" type="text"
                                  class="form-control form-control-sm @error('relationship') is-invalid @enderror"
                                  name="relationship[]" value="{{ $caregiver->relationship ?? '' }}"
                                  autocomplete="relationship" autofocus readonly>
                              </td>
                              <td>
                                <input id="phone_number_caregiver" type="text"
                                  class="form-control form-control-sm @error('phone_number_caregiver') is-invalid @enderror"
                                  name="phone_number_caregiver[]" value="{{ $caregiver->phone_number ?? '' }}"
                                  autocomplete="phone_number_caregiver" autofocus readonly>
                              </td>
                              <td>
                                <button type="button" onclick="removeRow(1)" class="remove"><i
                                    class="fas fa-minus-circle" disabled ></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @else
                          <tr id="1">
                            <td>
                              <input id="name_caregiver" type="text"
                                class="form-control form-control-sm @error('name_caregiver') is-invalid @enderror"
                                name="name_caregiver[]" value="{{ $caregiver->name ?? '' }}" autocomplete="name_caregiver"
                                autofocus readonly>
                            </td>
                            <td>
                              <input id="surname_caregiver" type="text"
                                class="form-control form-control-sm @error('surname_caregiver') is-invalid @enderror"
                                name="surname_caregiver[]" value="{{ $caregiver->surname ?? '' }}"
                                autocomplete="surname_caregiver" autofocus readonly>
                            </td>
                            <td>
                              <input id="relationship" type="text"
                                class="form-control form-control-sm @error('relationship') is-invalid @enderror"
                                name="relationship[]" value="{{ $caregiver->relationship ?? '' }}"
                                autocomplete="relationship" autofocus readonly>
                            </td>
                            <td>
                              <input id="phone_number_caregiver" type="text"
                                class="form-control form-control-sm @error('phone_number_caregiver') is-invalid @enderror"
                                name="phone_number_caregiver[]" value="{{ $caregiver->phone_number ?? '' }}"
                                autocomplete="phone_number_caregiver" autofocus readonly>
                            </td>
                            <td>
                              <button type="button" onclick="removeRow(1)" class="remove"><i
                                  class="fas fa-minus-circle"></i></button>
                            </td>
                          </tr>
                        @endif

                      </tbody>
                    </table>

                    <br />

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <a href="#personal" data-toggle="tab" class="btn btn-outline-primary">Regresar</a>
                        <a href="{{action('StudentController@edit',['id' => $student->id])}}" class="btn btn-primary">Editar</a>
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
