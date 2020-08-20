@extends('layouts.app')

@section('content')
@inject('grades','App\Services\Grades')


<div class="container">
    <div class="row justify-content-center ">

        <div class="col-md-8">

            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <div class="card-group">
                <div class="card">
                    @if(isset($student) && is_object($student))
                    <div class="card-header">MODIFICAR ESTUDIANTE</div>
                    @else
                    <div class="card-header">NUEVO ESTUDIANTE</div>
                    @endif

                    <div class="card-body">

                        <form method="POST" action="{{ isset($student) ? route('student.update') : route('student.store') }}" enctype="multipart/form-data"  aria-label="Configuración de mi cuenta">
                            {{csrf_field()}}


                            @if(isset($student) && is_object($student))
                            <input type="hidden" name="id" value="{{$student->id}}"/><br>
                            @endif


                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="form_personal" data-toggle="tab" href="#personal" role="tab"  aria-controls="personal" aria-selected="true" >PERSONAL</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="form_personal" data-toggle="tab" href="#academico" role="tab" aria-controls="academico" aria-selected="false">ACADEMICO</a>				   	
                                </li>
                            </ul>


                            <div class="tab-content" id="myTabContent" style="margin-top:16px;">
                                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="form_personal">

                                    <div class="form-group row">
                                        <label for="favorite_name" class="col-md-4 col-form-label text-md-right">COMO DESEA SER LLAMADO</label>

                                        <div class="col-md-6">
                                            <input id="favorite_name" type="text" class="form-control @error('favorite_name') is-invalid @enderror" name="favorite_name" value="{{$student->person->favorite_name ?? '' }}"required autocomplete="favorite_name" autofocus>


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
                                            <input id="names" type="text" class="form-control @error('names') is-invalid @enderror" name="names" value="{{$student->person->names ?? '' }}"required autocomplete="names" autofocus>

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
                                            <input id="first_surname" type="text" class="form-control @error('first_surname') is-invalid @enderror" name="first_surname" value="{{$student->person->first_surname ?? '' }}"required autocomplete="first_surname" autofocus>

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
                                            <input id="second_surname" type="text" class="form-control @error('second_surname') is-invalid @enderror" name="second_surname" value="{{$student->person->second_surname ?? '' }}"required autocomplete="second_surname" autofocus>

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
                                            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{$student->person->phone_number ?? '' }}"required autocomplete="phone_number" autofocus>

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
                                            <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{$student->birthday ?? '' }}"required autocomplete="birthday" autofocus>

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
                                            @switch($student->person->gender_id  ?? ''  ) 
                                            @case('F')
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender_id" id="FEMENINO" value="F" checked>
                                                <label class="form-check-label" for="FEMENINO">
                                                    FEMENINO
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender_id" id="MASCULINO" value="M" >
                                                <label class="form-check-label" for="MASCULINO">
                                                    MASCULINO
                                                </label>
                                            </div>
                                            @break
                                            @case('M')
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender_id" id="FEMENINO" value="F">
                                                <label class="form-check-label" for="FEMENINO">
                                                    FEMENINO
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender_id" id="MASCULINO" value="M" checked>
                                                <label class="form-check-label" for="MASCULINO">
                                                    MASCULINO
                                                </label>
                                            </div>
                                            @break
                                            @default
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender_id" id="FEMENINO" value="F">
                                                <label class="form-check-label" for="FEMENINO">
                                                    FEMENINO
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender_id" id="MASCULINO" value="M">
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

                                            @if($student->person->picture ?? '' )
                                            <div class="container-profile">
                                                <img  src="{{ route('student.picture', ['filename'=>$student->person->picture ])}}"class="picture_profile"  />
                                            </div>
                                            @endif

                                            <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" required>

                                            @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <a class="btn btn-outline-primary" id="profile-tab" data-toggle="tab" href="#academico" role="tab" aria-controls="academico" aria-selected="false">Siguiente </a>

                                            <button type="submit" class="btn btn-primary" >
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                    <br />
                                </div>

                                <div class="tab-pane fade" id="academico" role="tabpanel" aria-labelledby="form_personal">

                                    <div class="form-group row">
                                        <label for="grade" class="col-md-4 col-form-label text-md-right">GRADO</label>
                                        <div class="col-md-6">
                                            <select id="grade" name="grade_id" class="form-control  @error('grade_id') is-invalid @enderror" >
                                                @foreach($grades->get() as $index => $grade)

                                                <option value="{{$index}}" {{ old('grade_id',$student->grade_id ?? '' ) == $index ? 'selected' : '' }} >
                                                        {{ $grade }}
                                            </option> 

                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="second_surname" class="col-md-4 col-form-label text-md-right">CÓDIGO ESTADÍSTICO</label>

                                    <div class="col-md-6">
                                        <input id="student_code" type="text" class="form-control @error('student_code') is-invalid @enderror" name="student_code" value="{{$student->student_code ?? '' }}"required autocomplete="student_code" autofocus>

                                        @error('student_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                <div class="col-sm" style="text-align: center">
                                SI MIS PADRES NO PUEDEN RECOGERME EN EL COLEGIO, ME PUEDO IR CON:
                                
                                </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">NOMBRE</label>

                                            <div class="col-md-6">
                                                <input id="name_caregiver" type="text" class="form-control @error('name_caregiver') is-invalid @enderror" name="name_caregiver" value="{{$student->caregiver->name ?? '' }}"required autocomplete="student_code" autofocus>

                                                @error('student_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-auto">
                                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">APELLIDO</label>

                                            <div class="col-md-6">
                                                <input id="name_caregiver" type="text" class="form-control @error('name_caregiver') is-invalid @enderror" name="name_caregiver" value="{{$student->caregiver->name ?? '' }}"required autocomplete="student_code" autofocus>

                                                @error('student_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
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

@section('script')
<script>
    $(document).ready(function () {
        $('#grade').on('change', function () {
            var grade_id = $(this).val();
            if ($.trim(grade_id) != '') {
                $.get('subjects', {grade_id: grade_id}, function (subjects) {
                    $('#subject').empty();
                    $('#subject').append("<option value=''>Seleccione los cursos</option>");
                    $.each(subjects, function (index, value) {
                        $('#subject').append("<option value='" + index + "'>" + alue + "</option>");
                    })

                });
            }

        });


    });
</script>
@endsection