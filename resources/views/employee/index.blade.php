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
    <style>
      .status {
        cursor: pointer;
      }
  
    </style>

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
              @else
              @if (session('warning'))
              <div class="alert alert-danger">
                {{ session('warning') }}
              </div>  
              @endif
            @endif
            
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">@sortablelink('names','Nombre')</th>
                  <th scope="col">@sortablelink('first_surname','Apellido')</th>
                  <th scope="col">@sortablelink('job_id','Puesto')</th>
                  <th scope="col">@sortablelink('professor','Docente')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($employees as $employee)
                  <tr>
                    <td data-label="Nombre" scope="row"><a
                        href="{{ action('EmployeeController@detail', ['id' => $employee->id]) }}" />
                      {{ $employee->person->names }}
                    </td>

                    <td data-label="Apellido" scope="row"><a
                        href="{{ action('EmployeeController@detail', ['id' => $employee->id]) }}" />
                      {{ $employee->person->first_surname }}
                    </td>

                    <td data-label="Puesto"><a
                        href="{{ action('EmployeeController@detail', ['id' => $employee->id]) }}" />
                      {{ $employee->job->job }}
                      </a>
                    </td>

                    <td data-label="Docente"><a
                        href="{{ action('EmployeeController@detail', ['id' => $employee->id]) }}" />
                      @if ($employee->professor == 1)
                        Si
                      @else
                        No
                      @endif
                      </a>
                    </td>

                    <td data-label="Estado">
                      @if ($employee->status == 'INACTIVO')
                        <span id="status{{ $employee->id }}" onclick="changeStatus({{ $employee->id }})"
                          class="status badge badge-danger">
                          {{ $employee->status }}
                        </span>
                      @else
                        <span id="status{{ $employee->id }}" onclick="changeStatus({{ $employee->id }})"
                          class="status badge badge-success">
                          {{ $employee->status }}
                        </span>
                      @endif
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>

            {{ $employees->appends(Request::except('page'))->render() }}

            <p>
              Se muestran {{ $employees->count() }} de {{ $employees->total() }} empleados.
            </P>

          </div>

        </div>
      </div>
    </div>
  </div>

  <script>
    async function changeStatus(id) {
      try {
        const badge = $(`#status${id}`);
        let status = badge.text().trim();

        status = await axios.post('/employee/status', {
            id,
            status
          })
          .then(data => {
            const response = data.data;
            const {
              status
            } = response.data;

            badge
              .removeClass(status === 'INACTIVO' ? 'badge-success' : 'badge-danger')
              .addClass(status === 'INACTIVO' ? 'badge-danger' : 'badge-success');
            badge.text(status);

            return status;
          })
          .catch(err => console.error(err));
      } catch (error) {
        console.error(error);
      }
    }

  </script>

@endsection
