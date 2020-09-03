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
          <div class="card-header">Empleados</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('EmployeeController@create') }}" class="btn btn-primary">Nuevo </a>
              </div>
              <div class="col-md-auto">
                <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
              </div>
            </div>
            <br>

            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('name','Nombre')</th>
                  <th scope="col">@sortablelink('section','Sección')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($employees as $employee)
                  <tr>
                    <td data-label="Nombre" scope="row"><a
                        href="{{ action('EmployeeController@detail', ['id' => $employee->id]) }}" />
                      {{ $employee->person->name }}
                      {{ $employee->person->first_surname }}
                    </td>

                    <td data-label=""><a
                        href="{{ action('EmployeeController@detail', ['id' => $employee->id]) }}" />
                      {{ $employee->section }}
                      </a>
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>

            {{ $employees->appends(Request::except('page'))->render() }}

            <p>
              Se muestran {{ $employees->count() }} de {{ $employees->total() }} grados.
            </P>

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
