<h1>Datos</h1>
<br>


<table class="table">

    <tr style="text-align: left">
        <th>Nombre</th>
        <td>
            {{$estudiante->nombre1}}
            {{$estudiante->nombre2}}
            {{$estudiante->nombre3}}
        </td>
    </tr>

    <tr style="text-align: left">
        <th>Apellidos</th>
        <td>
            {{$estudiante->apellido1}}
            {{$estudiante->apellido2}}
        </td>
    </tr>


    <tr style="text-align: left">
        <th>Codigo Estudiante</th>
        <td>
            {{$estudiante->codigo_estudiante}}
        </td>
    </tr >

    <tr style="text-align: left">
        <th>Fecha de Inscripción</th>
        <td>
            {{$estudiante->fecha_inscripcion}}
        </td>
    </tr >

    <tr style="text-align: left">
        <th>Fecha de Nacimiento</th>
        <td>
            {{$estudiante->fecha_nacimiento}}
        </td>
    </tr>



</table>

<a href="{{action('EstudianteController@delete',['id' => $estudiante->id_estudiante])}}">Eliminar</a>
<a href="{{action('EstudianteController@edit',['id' => $estudiante->id_estudiante])}}">Actualizar</a>
