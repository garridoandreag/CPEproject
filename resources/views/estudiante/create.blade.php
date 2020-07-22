@if(isset($estudiante) && is_object($estudiante))
<h1>Modificar estudiante</h1>
@else
<h1>Crear un estudiante</h1>
@endif

<div class="container">
    <form action="{{isset($estudiante) ? action('EstudianteController@update') : action('EstudianteController@save')}}" method="POST"><!-- codigo_estudiante nombre1 nombre 2 nombre 3 apellido1 apellido2 fecha nacimiento fecha_inscripion email estado -->
        {{csrf_field()}}

        @if(isset($estudiante) && is_object($estudiante))
        <input type="hidden" name="id" value="{{$estudiante->id_estudiante}}"/><br>
        @endif

        <div class="row">
            <div class="col-25">
                <label for="nombre1">Primer Nombre:</label>
            </div>
            <div class="col-75">
                <input type="text" name="nombre1" value="{{$estudiante->nombre1 ?? '' }}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="nombre2">Segundo Nombre:</label>
            </div>
            <div class="col-75">
                <input type="text" name="nombre2" value="{{$estudiante->nombre2 ?? ''}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="nombre3">Tercer Nombre:</label>
            </div>
            <div class="col-75">
                <input type="text" name="nombre3" value="{{$estudiante->nombre3 ?? ''}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="apellido1">Primer Apellido:</label>
            </div>
            <div class="col-75">
                <input type="text" name="apellido1" value="{{$estudiante->apellido1 ?? ''}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="apellido2">Segundo Apellido:</label>
            </div>
            <div class="col-75">
                <input type="text" name="apellido2" value="{{$estudiante->apellido2 ?? ''}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="codigo_estudiante">Codigo Estudiantil:</label>
            </div>
            <div class="col-75">
                <input type="text" name="codigo_estudiante" value="{{$estudiante->codigo_estudiante ?? ''}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="fecha_inscripcion">Fecha Inscripcion:</label>
            </div>
            <div class="col-75">
                <input type="date" name="fecha_inscripcion" value="{{$estudiante->fecha_inscripcion ?? ''}}"/>
            </div>
        </div>


        <div class="row">
            <div class="col-25">
                <label for="fecha_nacimiento">Fecha Nacimiento:</label>
            </div>
            <div class="col-75">
                <input type="date" name="fecha_nacimiento" value="{{$estudiante->fecha_nacimiento ?? ''}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="email">Correo Electronico:</label>
            </div>
            <div class="col-75">
                <input type="text" name="email" value="{{$estudiante->email ?? ''}}"/>
            </div>
        </div>

        <div class="row">
            <input type="submit" value="Guardar"/>
        </div>
    </form>
</div>