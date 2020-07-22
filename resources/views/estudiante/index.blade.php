
<h1>Estudiantes</h2>
<h3><a href="{{action('EstudianteController@create')}}">Crear Estudiante </a> </h3>

@if(session('status'))
<p style="background:green;color:white;">
{{session('status')}}
</p>
@endif
<table>
    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Estado<th>
    </tr>

    @foreach($estudiante as $alumno)


    <tr>
        <td><a href="{{action('EstudianteController@detail',['id' => $alumno->id_estudiante])}}" />
            {{$alumno->nombre1}}
            </a>
        </td>
        <td><a href="{{action('EstudianteController@detail',['id' => $alumno->id_estudiante])}}" />
            {{$alumno->apellido1}}
            </a>
        </td>

        <td><a href="{{action('EstudianteController@detail',['id' => $alumno->id_estudiante])}}" />
            {{$alumno->estado}}
            </a>
        </td>
    </tr>

    @endforeach




</table>


