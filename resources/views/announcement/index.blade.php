@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/app.js') }}"></script>
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
          <div class="card-header">Avisos</div>
          <div class="card-body">

            <div class="row justify-content-md-center">
              <div class="col">
                <a href="{{ action('AnnouncementController@create') }}" class="btn btn-primary">Nuevo </a>
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
                  <th scope="col">@sortablelink('title','Titulo')</th>
                  <th scope="col">@sortablelink('description','Descripción')</th>
                  <th scope="col">@sortablelink('start_time','Inicio')</th>
                  <th scope="col">@sortablelink('end_time','Fin')</th>
                  <th scope="col">@sortablelink('status','Estado')</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach ($announcements as $announcement)
                  <tr>
                    <td data-label="Título" scope="row"><a
                        href="{{ action('AnnouncementController@detail', ['id' => $announcement->id]) }}" />
                      {{ $announcement->title }}
                    </td>
                    <td data-label="Descripción"><a
                        href="{{ action('AnnouncementController@detail', ['id' => $announcement->id]) }}" />
                      {{ substr($announcement->description, 0, 50) }}
                      </a>
                    </td>
                    <td data-label="Inicio"><a
                        href="{{ action('AnnouncementController@detail', ['id' => $announcement->id]) }}" />
                      {{ $announcement->start_time }}
                      </a>
                    </td>
                    <td data-label="Fin"><a
                        href="{{ action('AnnouncementController@detail', ['id' => $announcement->id]) }}" />
                      {{ $announcement->end_time }}
                      </a>
                    </td>
                    <td data-label="Estado">
                      @if ($announcement->status == 'INACTIVO')
                        <span id="status{{ $announcement->id }}" onclick="changeStatus({{ $announcement->id }})"
                          class="status badge badge-danger">
                          {{ $announcement->status }}
                        </span>
                      @else
                        <span id="status{{ $announcement->id }}" onclick="changeStatus({{ $announcement->id }})"
                          class="status badge badge-success">
                          {{ $announcement->status }}
                        </span>
                      @endif
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>

            {{ $announcements->appends(Request::except('page'))->render() }}

            <p>
              Se muestran {{ $announcements->count() }} de {{ $announcements->total() }} avisos.
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

        status = await axios.post('/Announcement/status', {
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
