@extends('layouts.app')

@section('content')
    @inject('grades','App\Services\Grades')
    @inject('genders','App\Services\Genders')
    @inject('subdivisions','App\Services\Subdivisions')
    <style>
        .select-dad {
            width: 100%;
        }

        .select-mom {
            width: 100%;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
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
           {{ isset($student) ? route('student.update') : route('student.store') }}" enctype="multipart/form-data"
                                aria-label="Configuración de mi cuenta">
                                {{ csrf_field() }}

                                @if (isset($student) && is_object($student))
                                    <input type="hidden" name="id" value="{{ $student->id }}" /><br>
                                @endif

                                <div class="form-group row">
                                    <label for="favorite_name" class="col-md-4 col-form-label text-md-right">Cómo desea ser
                                        llamado</label>

                                    <div class="col-md-6">
                                        <input id="favorite_name" type="text"
                                            class="form-control @error('favorite_name') is-invalid @enderror"
                                            name="favorite_name" value="{{ $student->person->favorite_name ?? '' }}"
                                            required autocomplete="favorite_name" autofocus>

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
                                        <input id="names" type="text"
                                            class="form-control @error('names') is-invalid @enderror" name="names"
                                            value="{{ $student->person->names ?? '' }}" required autocomplete="names"
                                            autofocus>
                                        @error('names')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-right">Primer
                                        apellido</label>
                                    <div class="col-md-6">
                                        <input id="first_surname" type="text"
                                            class="form-control @error('first_surname') is-invalid @enderror"
                                            name="first_surname" value="{{ $student->person->first_surname ?? '' }}"
                                            required autocomplete="first_surname" autofocus>
                                        @error('first_surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="second_surname" class="col-md-4 col-form-label text-md-right">Segundo
                                        apellido</label>
                                    <div class="col-md-6">
                                        <input id="second_surname" type="text"
                                            class="form-control @error('second_surname') is-invalid @enderror"
                                            name="second_surname" value="{{ $student->person->second_surname ?? '' }}"
                                            required autocomplete="second_surname" autofocus>
                                        @error('second_surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Teléfono de
                                        casa</label>
                                    <div class="col-md-6">
                                        <input id="phone_number" type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ $student->person->phone_number ?? '' }}"
                                            autocomplete="phone_number" autofocus>
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="subdivision_code"
                                        class="col-md-4 col-form-label text-md-right">Departamento</label>
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
                                    <label for="home_address" class="col-md-4 col-form-label text-md-right">Dirección de
                                        domicilio</label>
                                    <div class="col-md-6">
                                        <input id="home_address" type="text"
                                            class="form-control @error('home_address') is-invalid @enderror"
                                            name="home_address" value="{{ $student->person->home_address ?? '' }}"
                                            required autocomplete="home_address" autofocus>
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birthday" class="col-md-4 col-form-label text-md-right">Fecha de
                                        nacimiento</label>

                                    <div class="col-md-6">
                                        <input id="birthday" type="date"
                                            class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                            value="{{ $student->birthday ?? '' }}" required autocomplete="birthday"
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
                                    <label for="picture"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                                    <div class="col-md-6">

                                        @if ($student->person->picture ?? '')
                                            <div class="container-profile">
                                                <img src="{{ route('student.picture', ['filename' => $student->person->picture]) }}"
                                                    class="picture_profile" />
                                            </div>
                                        @endif

                                        <input id="picture" type="file"
                                            class="form-control @error('picture') is-invalid @enderror" name="picture">

                                        @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <br />

                                <div class="form-group row">
                                    <label for="second_surname" class="col-md-4 col-form-label text-md-right">Código
                                        Estadístico</label>

                                    <div class="col-md-6">
                                        <input id="student_code" type="text"
                                            class="form-control @error('student_code') is-invalid @enderror"
                                            name="student_code" value="{{ $student->student_code ?? '' }}"
                                            autocomplete="student_code" autofocus>

                                        @error('student_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <br>
                                <div class="card-footer">
                                    <p class="card-text text-center "><b>Padres o Encargados</b></p>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="col">
                                            <label for="dad_id">Papá</label>
                                            <select name="dad_id" class="select-dad" id="select-dad">
                                                <option value="{{ $dadstudent->tutor_id ?? '' }}"
                                                    {{ old('dadstudent') ? 'selected' : '' }}>
                                                    {{ $dadstudent->names ?? '' }}
                                                    {{ $dadstudent->first_surname ?? '' }}
                                                    {{ $dadstudent->second_surname ?? '' }}
                                                </option>
                                            </select>

                                            @error('tutor_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col">
                                            <label for="mom_id">Mamá</label>
                                            <select name="mom_id" class="select-mom" id="select-mom">
                                                <option value="{{ $momstudent->tutor_id ?? '' }}"
                                                    {{ old('momstudent') ? 'selected' : '' }}>
                                                    {{ $momstudent->names ?? '' }}
                                                    {{ $momstudent->first_surname ?? '' }}
                                                    {{ $momstudent->second_surname ?? '' }}
                                                </option>
                                            </select>

                                            @error('tutor_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                <br>
                                <div class="card-footer">
                                    <p class="card-text text-center "><b>El estudiante podrá ser recodigo del colegio por:
                                        </b></p>
                                </div>

                                <table class="table table-borderless table-sm" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Parentesco</th>
                                            <th>Teléfono</th>
                                            <th style="width: 10.344827586207%;"><a href="#" class="addRow" id="addRow">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($student->caregiver))
                                            @foreach ($student->caregiver as $caregiver)
                                                <tr id="1">
                                                    <td data-label="Nombre" scope="row">
                                                        <input id="name_caregiver" type="text"
                                                            class="form-control form-control-sm @error('name_caregiver') is-invalid @enderror"
                                                            name="name_caregiver[]" value="{{ $caregiver->name ?? '' }}"
                                                            autocomplete="name_caregiver" autofocus>
                                                    </td>
                                                    <td data-label="Apellido" scope="row">
                                                        <input id="surname_caregiver" type="text"
                                                            class="form-control form-control-sm @error('surname_caregiver') is-invalid @enderror"
                                                            name="surname_caregiver[]"
                                                            value="{{ $caregiver->surname ?? '' }}"
                                                            autocomplete="surname_caregiver" autofocus>
                                                    </td>
                                                    <td data-label="Parentesco" scope="row">
                                                        <input id="relationship" type="text"
                                                            class="form-control form-control-sm @error('relationship') is-invalid @enderror"
                                                            name="relationship[]"
                                                            value="{{ $caregiver->relationship ?? '' }}"
                                                            autocomplete="relationship" autofocus>
                                                    </td>
                                                    <td data-label="Teléfono" scope="row">
                                                        <input id="phone_number_caregiver" type="text"
                                                            class="form-control form-control-sm @error('phone_number_caregiver') is-invalid @enderror"
                                                            name="phone_number_caregiver[]"
                                                            value="{{ $caregiver->phone_number ?? '' }}"
                                                            autocomplete="phone_number_caregiver" autofocus>
                                                    </td>
                                                    <td>
                                                        <button type="button" onclick="removeRow(1)" class="remove"><i
                                                                class="fas fa-minus-circle"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr id="1">
                                                <td data-label="Nombre" scope="row">
                                                    <input id="name_caregiver" type="text"
                                                        class="form-control form-control-sm @error('name_caregiver') is-invalid @enderror"
                                                        name="name_caregiver[]" value="{{ $caregiver->name ?? '' }}"
                                                        autocomplete="name_caregiver" autofocus>
                                                </td>
                                                <td data-label="Apellido" scope="row">
                                                    <input id="surname_caregiver" type="text"
                                                        class="form-control form-control-sm @error('surname_caregiver') is-invalid @enderror"
                                                        name="surname_caregiver[]"
                                                        value="{{ $caregiver->surname ?? '' }}"
                                                        autocomplete="surname_caregiver" autofocus>
                                                </td>
                                                <td data-label="Parentesco" scope="row">
                                                    <input id="relationship" type="text"
                                                        class="form-control form-control-sm @error('relationship') is-invalid @enderror"
                                                        name="relationship[]"
                                                        value="{{ $caregiver->relationship ?? '' }}"
                                                        autocomplete="relationship" autofocus>
                                                </td>
                                                <td data-label="Teléfono" scope="row">
                                                    <input id="phone_number_caregiver" type="text"
                                                        class="form-control form-control-sm @error('phone_number_caregiver') is-invalid @enderror"
                                                        name="phone_number_caregiver[]"
                                                        value="{{ $caregiver->phone_number ?? '' }}"
                                                        autocomplete="phone_number_caregiver" autofocus>
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
                                        <a href="{{ route('student.index') }}"
                                            class="btn btn-outline-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">
                                            Guardar
                                        </button>

                                        @if (isset($student) && is_object($student))
                                            <a href="{{ action('StudentController@destroy', ['id' => $student->id]) }}"
                                                class="btn btn-danger">Eliminar</a>
                                        @endif
                                    </div>
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
        var row = 1;
        $('.addRow').on('click', function() {
            addRow();
        });

        function addRow() {
            row++;
            var tr =
                `<tr id="${row}">
          <td><input type="text" class="form-control form-control-sm" name = "name_caregiver[]" value = "{{ $caregiver->name ?? '' }}" required></td>
          <td><input type="text" class="form-control form-control-sm" name = "surname_caregiver[]" value = "{{ $caregiver->surname ?? '' }}" required></td>
          <td><input type="text" class="form-control form-control-sm" name = "relationship[]" value = "{{ $caregiver->relationship ?? '' }}" required></td>
          <td><input type="text" class="form-control form-control-sm" name = "phone_number_caregiver[]" value = "{{ $caregiver->phone_number ?? '' }}" required></td>
          <td><button type="button" onclick="removeRow(${row})" class="remove"><i class="fas fa-minus-circle"></i></button></td></tr>`;
            $('tbody').append(tr);
        };

        function removeRow(id) {
            $(`#${id}`).remove();
        }



        $(document).ready(function() {
            const select = $('#select-dad');
            select.select2({

                ajax: {
                    type: 'POST',
                    url: '/tutor/search-dad',
                    data: function(params) {
                        return {
                            surname: params.term,
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


        $(document).ready(function() {
            const select = $('#select-mom');
            select.select2({

                ajax: {
                    type: 'POST',
                    url: '/tutor/search-mom',
                    data: function(params) {
                        return {
                            surname: params.term,
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
