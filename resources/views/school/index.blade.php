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
          <div class="card-header">Colegio</div>
          <div class="card-body">
            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="{{ action('SchoolController@create') }}" class="btn btn-primary">Nuevo </a>
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
                  <th scope="col">@sortablelink('phone_number','Teléfono')</th>
                  <th scope="col">@sortablelink('address','Dirección')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($schools as $school)
                  <tr>
                    <td data-label="Nombre" scope="row"><a
                        href="{{ action('SchoolController@detail', ['id' => $school->id]) }}" />
                      {{ $school->name }}
                    </td>
                    <td data-label="Teléfono"><a href="{{ action('SchoolController@detail', ['id' => $school->id]) }}" />
                      {{ $school->phone_number }}
                      </a>
                    </td>
                    <td data-label="Dirección"><a href="{{ action('SchoolController@detail', ['id' => $school->id]) }}" />
                      {{ $school->address }}
                      </a>
                    </td>

                  </tr>
                @endforeach

              </tbody>
            </table>
            <br>
            {{ $schools->appends(Request::except('page'))->render() }}
            <br>
            <p>
              Se muestran {{ $schools->count() }} de {{ $schools->total() }} entidades del colegio.
            </P>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
