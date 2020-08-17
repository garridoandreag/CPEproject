@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">



            <div class="card">
                <div class="card-header">ESTUDIANTES

                </div>


                <div class="card-body">
                    
                    <div class="row justify-content-md-center">
                        <div class="col">
                    <a href="{{action('StudentController@create')}}" class="btn btn-primary">Nuevo </a>
                        </div>
                    <div class="col-md-auto">
                    <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
                    </div>
                    </div>
                    <br>

                    @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">Foto</th>
                            </tr>
                        </thead>
                        <tbody  id="myTable">
                            @foreach($student as $student)
                            <tr>
                                <td data-label="Código" scope="row">1</td>
                                <td data-label="Nombres"><a href="{{action('StudentController@detail',['id' => $student->id])}}" />
                                    {{$student->person->names}}
                                    </a>
                                </td>
                                <td data-label="Apellidos"><a href="{{action('StudentController@detail',['id' => $student->id])}}" />
                                    {{$student->person->first_surname}}
                                    {{$student->person->second_surname}}
                                    </a>
                                </td>
                                <td data-label="Fecha Nacimiento"><a href="{{action('StudentController@detail',['id' => $student->id])}}" />
                                    {{$student->birthday}}
                                    </a>
                                </td>
                                <td data-label="Foto"><a href="{{action('StudentController@detail',['id' => $student->id])}}" />
                                    @if($student->person->picture)
                                    <div class="container-person_profile" >
                                        <img  src="{{ route('student.picture', ['filename'=>$student->person->picture])}}"class="picture_profile"  />
                                    </div>
                                    @endif
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection