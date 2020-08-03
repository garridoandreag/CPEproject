@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">



            <div class="card">
                <div class="card-header">Estudiantes</div>

                <div class="card-body">

                    <table class="table table-hover" class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student as $student)
                            <tr>
                                <td scope="row">1</td>
                                <td>
                                    {{$student->person->names}}
                                </td>
                                <td>
                                    {{$student->person->first_surname}}
                                    {{$student->person->second_surname}}
                                </td>
                                <td>
                                    {{$student->birthday}}
                                </td>
                                <td>
                                    @if($student->person->picture)
                                    <div class="container-person_profile">
                                        <img src="{{ route('student.picture', ['filename'=>$student->person->picture])}}"class="picture_profile"  />
                                    </div>
                                    @endif
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