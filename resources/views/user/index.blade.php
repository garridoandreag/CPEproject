@extends('layouts.app')

@section('content')
<script src="{{ asset('js/axios.js') }}" ></script>
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
          <div class="card-header">Usuarios</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ route('admin.admin') }}" class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>
                <a href="{{ route('register') }}" class="btn btn-primary">Nuevo </a>
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
                  <th scope="col">@sortablelink('email','ID Usuario')</th>
                  <th scope="col">@sortablelink('name','Nombre a mostrar')</th>
                  <th scope="col">@sortablelink('names','Nombre Completo')</th>
                  <th scope="col">@sortablelink('role_id','Rol')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($users as $user)
                  <tr>
                    <td data-label="ID Usuario"><a href="{{ action('UserController@detail', ['id' => $user->id]) }}" />
                      {{ $user->email }}
                      </a>
                    </td>
                    <td data-label="Nombre a mostrar" scope="row"><a
                        href="{{ action('UserController@detail', ['id' => $user->id]) }}" />
                      {{ $user->name }}
                    </td>
                    <td data-label="Nombre Completo"><a href="{{ action('UserController@detail', ['id' => $user->id]) }}" />
                      {{ $user->person->names }}
                      {{ $user->person->first_surname }}
                      {{ $user->person->second_surname }}
                      </a>
                    </td>

                    <td data-label="Rol"><a
                        href="{{ action('UserController@detail', ['id' => $user->id]) }}" />
                      {{ $user->role->name }}
                      </a>
                    </td>
                    <td data-label="Estado" scope="row">
                      @if ($user->status == 'INACTIVO')
                        <span id="status{{ $user->id }}" onclick="changeStatus({{ $user->id }})"
                          class="status badge badge-danger">
                        </span>
                      @else
                            <span id="status{{ $user->id }}" onclick="changeStatus({{ $user->id }})"
                              class="status badge badge-success">
                              {{ $user->status }}
                            </span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            {{ $users->appends(Request::except('page'))->render() }}

            <p>
              Se muestran {{ $users->count() }} de {{ $users->total() }} usuarios.
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

        status = await axios.post('/user/status', {
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
