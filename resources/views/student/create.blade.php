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
                    <a class="nav-link active" id="form_personal" data-toggle="tab" href="#personal" role="tab"
                      aria-controls="personal" aria-selected="true">Personal</a>
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
                          autofocus>

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
                          autofocus>

                        @error('names')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="first_name" class="col-md-4 col-form-label text-md-right">Primer Apellido</label>

                      <div class="col-md-6">
                        <input id="first_surname" type="text"
                          class="form-control @error('first_surname') is-invalid @enderror" name="first_surname"
                          value="{{ $student->person->first_surname ?? '' }}" required autocomplete="first_surname"
                          autofocus>

                        @error('first_surname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="second_surname" class="col-md-4 col-form-label text-md-right">Segundo Apellido</label>

                      <div class="col-md-6">
                        <input id="second_surname" type="text"
                          class="form-control @error('second_surname') is-invalid @enderror" name="second_surname"
                          value="{{ $student->person->second_surname ?? '' }}" required autocomplete="second_surname"
                          autofocus>

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
                          autofocus>

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
                          class="form-control  @error('subdivision_code') is-invalid @enderror">
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
                      <label for="birthday" class="col-md-4 col-form-label text-md-right">Fecha de Nacimiento</label>

                      <div class="col-md-6">
                        <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror"
                          name="birthday" value="{{ $student->birthday ?? '' }}" required autocomplete="birthday"
                          autofocus>

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
                          class="form-control  @error('gender_id') is-invalid @enderror">
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
                          name="picture" required>

                        @error('picture')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <a class="btn btn-outline-primary" id="profile-tab" data-toggle="tab" href="#academico" role="tab"
                          aria-controls="academico" aria-selected="false">Siguiente </a>

                        <button type="submit" class="btn btn-primary">
                          Guardar
                        </button>
                      </div>
                    </div>
                    <br />
                  </div>

                  <div class="tab-pane fade" id="academico" role="tabpanel" aria-labelledby="form_personal">

                    <div class="form-group row">
                      <label for="grade" class="col-md-4 col-form-label text-md-right">Grado</label>
                      <div class="col-md-6">
                        <select id="grade" name="grade_id" class="form-control  @error('grade_id') is-invalid @enderror">
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
                          value="{{ $student->student_code ?? '' }}" required autocomplete="student_code" autofocus>

                        @error('student_code')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <br>
                    <br>

                    <p class="card-text text-center"><small class="text-muted">
                        QUIEN PUEDE RECOGER AL ESTUDIANTE:
                      </small></p>

                    <table class="table table-bordered" id="myTable">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Parentesco</th>
                          <th>Teléfono</th>
                          <th><a href="#" class="addRow" id="addRow">
                              <i class="fas fa-plus-circle"></i>
                            </a>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input id="name_caregiver" type="text"
                              class="form-control form-control-sm @error('name_caregiver') is-invalid @enderror"
                              name="name_caregiver[]" value="{{ $caregiver->name ?? '' }}" required
                              autocomplete="name_caregiver" autofocus>
                          </td>
                          <td>
                            <input id="surname_caregiver" type="text"
                              class="form-control form-control-sm @error('surname_caregiver') is-invalid @enderror"
                              name="surname_caregiver[]" value="{{ $caregiver->surname ?? '' }}" required
                              autocomplete="surname_caregiver" autofocus>
                          </td>
                          <td>
                            <input id="relationship" type="text"
                              class="form-control form-control-sm @error('relationship') is-invalid @enderror"
                              name="relationship[]" value="{{ $caregiver->relationship ?? '' }}" required
                              autocomplete="relationship" autofocus>
                          </td>
                          <td>
                            <input id="phone_number_caregiver" type="text"
                              class="form-control form-control-sm @error('phone_number_caregiver') is-invalid @enderror"
                              name="phone_number_caregiver[]" value="{{ $caregiver->phone_number ?? '' }}" required
                              autocomplete="phone_number_caregiver" autofocus>
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-sm remove">
                              <i class="fas fa-minus-circle"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>

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
  <script type="text/javascript">
    $('.addRow').on('click', function() {
      addRow();
    });

    function addRow() {
      var tr = '<tr>' +
        '<td><input type="text" class="form-control form-control-sm" name = "name_caregiver[]" value = "{{ $caregiver->name ?? '' }}" required></td>'+
        '<td><input type="text" class="form-control form-control-sm" name = "surname_caregiver[]" value = "{{ $caregiver->surname ?? '' }}" required></td>'+
        '<td><input type="text" class="form-control form-control-sm" name = "relationship[]" value = "{{ $caregiver->relationship ?? '' }}" required></td>'+
        '<td><input type="text" class="form-control form-control-sm" name = "phone_number_caregiver[]" value = "{{ $caregiver->phone_number ?? '' }}" required></td>'+
        '<td><a href="#" class="btn btn-danger btn-sm remove"><i class="fas fa-minus-circle"></i></a></td>'+'</tr>';
      $('tbody').append(tr);
    };

  </script>
@endsection
