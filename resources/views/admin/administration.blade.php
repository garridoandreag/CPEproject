@extends('layouts.app')

@section('content')

  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

  </script>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Administración</div>
          <div class="card-body">
            <a href="#" class="btn btn-light" id="menu-admin">
              <img src="images/usuario.png" class="btn-menu">
              <br>
              Usuarios</a>

            <a href="{{ route('school.index') }}" class="btn btn-light" id="menu-admin">
              <img src="images/colegio.png" class="btn-menu">
              <br>
              Colegio</a>

            <a href="{{ route('course.index') }}" class="btn btn-light" id="menu-admin">
              <img src="images/cursos.png" class="btn-menu">
              <br>
              Cursos</a>

            <a href="{{ route('grade.index') }}" class="btn btn-light" id="menu-admin">
              <img src="images/grado.png" class="btn-menu">
              <br>
              Grados</a>

            <a href="{{ route('cycle.index') }}" class="btn btn-light" id="menu-admin">
              <img src="images/reloj.png" class="btn-menu">
              <br>
              Ciclo</a>

            <a href="{{ route('announcement.index') }}" class="btn btn-light" id="menu-admin">
              <img src="images/announcement.png" class="btn-menu">
              <br>
              Avisos</a>

            <a href="#" class="btn btn-light" id="menu-admin">
              <img src="images/calendario.png" class="btn-menu">
              <br>
              Eventos</a>

            <a href="#" class="btn btn-light" id="menu-admin">
              <img src="images/cuenta.png" class="btn-menu">
              <br>
              Categoria pago</a>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

@endsection
