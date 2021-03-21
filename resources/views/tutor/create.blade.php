@extends('layouts.app')

@section('content')
  @inject('subdivisions','App\Services\Subdivisions')
  @inject('students','App\Services\Students')
  @inject('genders','App\Services\Genders')
  @inject('relationships','App\Services\Relationships')
 
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
              @if (isset($tutor) && is_object($tutor))
                Modificar Padre (Encargado)
              @else
                Nuevo Padre (Encargado)
              @endif
            </div>

            <div class="card-body">
              @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
              @else
              @if (session('warning'))
                <div class="alert alert-danger">
                  {{ session('warning') }}
                </div>
              @endif
            @endif
              <form id="tutorForm" method="POST"
                action="{{ isset($tutor) ? route('tutor.update') : route('tutor.store') }}" enctype="multipart/form-data"
                aria-label="Configuración de mi cuenta">
                {{ csrf_field() }}

                @if (isset($tutor) && is_object($tutor))
                  <input type="hidden" name="id" value="{{ $tutor->id }}" /><br>
                @endif


                <div class="form-group row">
                  <label for="names" class="col-md-4 col-form-label text-md-right">Nombres</label>

                  <div class="col-md-6">
                    <input id="names" type="text" class="form-control @error('names') is-invalid @enderror" name="names"
                      value="{{ $tutor->person->names ?? '' }}" required autocomplete="names" autofocus>
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
                      value="{{ $tutor->person->first_surname ?? '' }}" required autocomplete="first_surname" autofocus>
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
                      value="{{ $tutor->person->second_surname ?? '' }}" required autocomplete="second_surname" autofocus>
                    @error('second_surname')
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
                          {{ old('gender_id', $tutor->person->gender_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $gender }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="phone_number" class="col-md-4 col-form-label text-md-right">Teléfono </label>
                  <div class="col-md-6">
                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror"
                      name="phone_number" value="{{ $tutor->person->phone_number ?? '' }}" required
                      autocomplete="phone_number" autofocus>
                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>


                <div class="form-group row">
                  <label for="cellphone_number" class="col-md-4 col-form-label text-md-right">Celular</label>
                  <div class="col-md-6">
                    <input id="cellphone_number" type="text"
                      class="form-control @error('cellphone_number') is-invalid @enderror" name="cellphone_number"
                      value="{{ $tutor->person->cellphone_number ?? '' }}" required autocomplete="cellphone_number"
                      autofocus>
                    @error('cellphone_number')
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
                          {{ old('subdivision_code', $tutor->person->subdivision_code ?? '') == $index ? 'selected' : '' }}>
                          {{ $subdivision }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="home_address" class="col-md-4 col-form-label text-md-right">Dirección de domicilio</label>
                  <div class="col-md-6">
                    <input id="home_address" type="text" class="form-control @error('home_address') is-invalid @enderror"
                      name="home_address" value="{{ $tutor->person->home_address ?? '' }}" required
                      autocomplete="home_address" autofocus>
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
                      value="{{ $tutor->dpi ?? '' }}" required autocomplete="dpi" autofocus>
                    @error('dpi')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="occupation" class="col-md-4 col-form-label text-md-right">Ocupación</label>
                  <div class="col-md-6">
                    <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror"
                      name="occupation" value="{{ $tutor->occupation ?? '' }}" required autocomplete="occupation"
                      autofocus>
                    @error('occupation')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <br>
                <div class="card-footer">
                  <p class="card-text text-center "><b>Estudiantes de los que es responsable:</b></p>
                </div>
                <table class="table table-bordered" id="myTable">
                  <thead>
                    <tr>
                      <th>Estudiante</th>
                      <th>Parentesco</th>
                      <th><a href="#" class="addRow" id="addRow">
                          <i class="fas fa-plus-circle"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($tstudents))
                    @foreach ($tstudents as $tstudent)
                    <tr id="1">
                      <td data-label="Estudiante" scope="row">
                        <div class="input-group input-group-sm">
                          <select id="student_id" name="student_id[]" class="form-control ">
                            @foreach ($students->get() as $index => $student)

                            <option value="{{ $index }}"
                              {{ old('student_id', $tstudent->student_id ?? '') == $index ? 'selected' : '' }}>
                              {{ $student }}
                            </option>
    
                          @endforeach
                          </select>
                        </div>
                      </td>
                      <td data-label="Parentesco" scope="row">
                        <div class="input-group input-group-sm">
                          <select id="relationship" name="relationship[]" class="form-control ">
                            @foreach ($relationships->get() as $relationship)
                            <option value="{{ $relationship }}"
                            {{ old('relationship', $tstudent->relationship ?? '') == $relationship ? 'selected' : '' }} >
                                {{ $relationship }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </td>
                      <td>
                            @if (isset($tstudent) && is_object($tstudent))
                            <a href="{{action('TutorController@destroystudent',['tutor_id' => $tstudent->tutor_id,'student_id' => $tstudent->student_id])}}" class="btn btn-danger">Eliminar</a>
                            @endif
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
                <br>



                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('tutor.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                      Guardar
                    </button>
                  </div>
                </div>
                <br>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var row = 1;
    $('.addRow').on('click', function() {
      addRow();
    });

    function addRow() {
      row++;
      var tr =
        `<tr id="${row}">
          <td data-label="Estudiante" scope="row">
                        <div class="input-group input-group-sm">
                          <select id="student_id" name="student_id[]" class="form-control ">
                            @foreach ($students->get() as $index => $student)

                            <option value="{{ $index }}"
                              {{ old('student_id', $tutor->studenttutor->student_id ?? '') == $index ? 'selected' : '' }}>
                              {{ $student }}
                            </option>
    
                          @endforeach
                          </select>
                        </div>
                      </td>

              <td data-label="Parentesco" scope="row">
                          <div class="input-group input-group-sm">
                            <select id="relationship" name="relationship[]" class="form-control ">
                              @foreach ($relationships->get() as $relationship)
                                <option value="{{ $relationship }}"
                                  {{ old('relationship', $tutor->studenttutor->relationship ?? '') == $relationship ? 'selected' : '' }}>
                                  {{ $relationship }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                        </td>

              <td><button type="button" onclick="removeRow(${row})" class="remove">
                  <i class="fas fa-minus-circle"></i>
                  </button>
              </td>
            </tr>`;
      $('tbody').append(tr);
    };

    function removeRow(id) {
      $(`#${id}`).remove();
    }

  </script>
@endsection
