@extends('layouts.app')

@section('content')
  @inject('jobs','App\Services\Jobs')
  @inject('subdivisions','App\Services\Subdivisions')
  @inject('genders','App\Services\Genders')
  @inject('status','App\Services\Status')

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
              @if (isset($employee) && is_object($employee))
                Modificar Empleado
              @else
                Nuevo Empleado
              @endif
            </div>

            <div class="card-body">

              <form id="gradeForm" method="POST"
                action="{{ isset($employee) ? route('employee.update') : route('employee.store') }}"
                enctype="multipart/form-data" aria-label="Empleados">
                {{ csrf_field() }}

                @if (isset($employee) && is_object($employee))
                  <input type="hidden" name="id" value="{{ $employee->id }}" /><br>
                @endif

                <div class="form-group row">
                  <label for="names" class="col-md-4 col-form-label text-md-right">Nombre</label>

                  <div class="col-md-6">
                    <input id="names" type="text" class="form-control @error('names') is-invalid @enderror" name="names"
                      value="{{ $employee->person->names ?? '' }}" required autocomplete="names" autofocus readonly>

                    @error('names')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="first_surname" class="col-md-4 col-form-label text-md-right">Primer Apellido</label>

                  <div class="col-md-6">
                    <input id="first_surname" type="text"
                      class="form-control @error('first_surname') is-invalid @enderror" name="first_surname"
                      value="{{ $employee->person->first_surname ?? '' }}" required autocomplete="first_surname"
                      autofocus readonly>

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
                      class="form-control @error('second_urname') is-invalid @enderror" name="second_surname"
                      value="{{ $employee->person->second_surname ?? '' }}" required autocomplete="second_surname"
                      autofocus readonly>

                    @error('second_surname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="phone_number" class="col-md-4 col-form-label text-md-right">Número de Teléfono</label>

                  <div class="col-md-6">
                    <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                      name="phone_number" value="{{ $employee->person->phone_number ?? '' }}" required
                      autocomplete="phone_number" autofocus readonly>

                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cellphone_number" class="col-md-4 col-form-label text-md-right">Número de Celular</label>

                  <div class="col-md-6">
                    <input id="cellphone_number" type="tel"
                      class="form-control @error('cellphone_number') is-invalid @enderror" name="cellphone_number"
                      value="{{ $employee->person->cellphone_number ?? '' }}" required autocomplete="cellphone_number"
                      autofocus readonly>

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
                      class="form-control  @error('subdivision_code') is-invalid @enderror"  disabled>
                      @foreach ($subdivisions->get() as $index => $subdivision)
                        <option value="{{ $index }}"
                          {{ old('subdivision_code', $employee->person->subdivision_code ?? '') == $index ? 'selected' : '' }}>
                          {{ $subdivision }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="home_address" class="col-md-4 col-form-label text-md-right">Dirección</label>

                  <div class="col-md-6">
                    <input id="home_address" type="text" class="form-control @error('home_address') is-invalid @enderror"
                      name="home_address" value="{{ $employee->person->home_address ?? '' }}" required
                      autocomplete="home_address" autofocus readonly>

                    @error('home_address')
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
                      class="form-control  @error('gender_id') is-invalid @enderror"  disabled>
                      @foreach ($genders->get() as $index => $gender)

                        <option value="{{ $index }}"
                          {{ old('gender_id', $employee->person->gender_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $gender }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="job_id" class="col-md-4 col-form-label text-md-right">Puesto</label>
                  <div class="col-md-6">
                    <select id="job_id" name="job_id" class="form-control  @error('job_id') is-invalid @enderror"  disabled>
                      @foreach ($jobs->get() as $index => $job)

                        <option value="{{ $index }}"
                          {{ old('job_id', $employee->job_id ?? '') == $index ? 'selected' : '' }}>
                          {{ $job }}
                        </option>

                      @endforeach
                    </select>
                  </div>
                </div>

                @if (isset($employee) && is_object($employee))
                  <div class="form-group row">
                    <label for="'status'" class="col-md-4 col-form-label text-md-right">Estado</label>
                    <div class="col-md-6">
                      <select id="status" name="status" class="form-control  @error('status') is-invalid @enderror"  disabled>
                        @foreach ($status->get() as $status)

                          <option value="{{ $status }}"
                            {{ old('status', $employee->status ?? '') == $status ? 'selected' : '' }}>
                            {{ $status }}
                          </option>

                        @endforeach

                      </select>
                    </div>
                  </div>
                @endif

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <a href="{{ route('employee.index') }}" class="btn btn-outline-primary">Regresar </a>
                    <a href="{{action('EmployeeController@edit',['id' => $employee->id])}}" class="btn btn-primary">Editar</a>

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
