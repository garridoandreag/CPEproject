@extends('layouts.app')

@section('content')


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
                    <div class="card-header">NUEVO ESTUDIANTE</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data"  aria-label="Configuración de mi cuenta">
                            @csrf


                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="form_personal" data-toggle="tab" href="#personal" role="tab"  aria-controls="personal" aria-selected="true" >PERSONAL</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ACADEMICO</a>				   	
                                </li>
                            </ul>


                            <div class="tab-content" id="myTabContent" style="margin-top:16px;">
                                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="form_personal">


                                    <div class="form-group row">
                                        <label for="first_name" class="col-md-4 col-form-label text-md-right">NOMBRE</label>

                                        <div class="col-md-6">
                                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$student->person->first_name ?? '' }}"required autocomplete="first_name" autofocus>

                                            @error('first_name')
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
                                        <label for="picture" class="col-md-4 col-form-label text-md-right">FOTO PERFIL</label>

                                        <div class="col-md-6">

                                            @include('includes.picture_profile')
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
                                            <button type="submit" class="btn btn-primary">
                                                Actualizar
                                            </button>
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