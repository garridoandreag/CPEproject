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
                <div class="card-header">PADRES O ENCARGADOS
               </div>

               <div class="card-body">
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <a href="{{action('TutorController@create')}}" class="btn btn-primary">Nuevo </a>
                        </div>
                        <div class="col-md-auto">
                            <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
                        </div>
                    </div>
                    <br>

                    @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Estudiante</th>
                                <th scope="col">Grado</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Numero Teléfonico</th>
                                
                            </tr>
                        </thead>
                        <tbody  id="myTable">
                            @foreach($tutors as $tutor)
                            <tr>
                                <td data-label="Código" scope="row"><a href="{{action('StudentController@detail',['id' => $tutor->id])}}" />
                                    
                                </td>
                                <td data-label="Foto"><a href="{{action('StudentController@detail',['id' => $tutor->id])}}" />
                                  @if($tutor->person->picture)
                                  <div class="container-person_profile" >
                                      <img  src="{{ route('student.picture', ['filename'=>$tutor->person->picture])}}"class="picture_profile"  />
                                  </div>
                                  @endif
                                  </a>
                              </td>
                                <td data-label="Nombres"><a href="{{action('TutorController@detail',['id' => $tutor->id])}}" />
                                    {{$tutor->person->names}}
                                    </a>
                                </td>
                                <td data-label="Apellidos"><a href="{{action('TutorController@detail',['id' => $tutor->id])}}" />
                                    {{$tutor->person->first_surname}}
                                    {{$tutor->person->second_surname}}
                                    </a>
                                </td>
                                <td data-label="Fecha Nacimiento"><a href="{{action('TutorController@detail',['id' => $tutor->id])}}" />
                                    {{$tutor->person->phone_number}}
                                    </a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $tutors->links() }}

             </div>

            </div>
        </div>
    </div>
</div>

@endsection
