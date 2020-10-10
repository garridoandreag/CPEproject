@extends('layouts.app')

@section('content')
  @inject('announcements','App\Services\Announcements')
  @inject('homeworks','App\Services\Homeworks')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="card border-primary">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h3 class="display-4">¡Buen día {{ Auth::user()->name }}!</h3>
              <p class="lead">A continuación información que te puede interesar...</p>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-outline-light btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Información
                  </button>
                </h2>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  @if (Auth::user()->role_id == 3)

                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">@sortablelink('','Asignatura')</th>
                          <th scope="col">@sortablelink('','Tareas pendientes de calificar')</th>
                        </tr>
                      </thead>
                      <tbody id="myTable">
                        @foreach ($homeworks->get() as $homework)
                          <tr>
                            <td data-label="Asignatura" scope="row">
                              {{ $homework->asignatura }}
                            </td>
                            <td data-label="Tareas pendientes de calificar" scope="row">
                              {{ $homework->cantidad }}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                  @endif
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <br>
      <div class="col-md-3">



        @foreach ($announcements->get() as $index => $announcement)
          <div class="card border-primary mb-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><b>Aviso: {{ $announcement->title }}</b></li>
            </ul>

            <div class="card-body">

              <p class="card-text">{{ $announcement->description }}</p>

            </div>
            <div class="card-footer text-muted">
              <small class="text-muted"> Publicado en: {{ $announcement->start_time }}</small>
            </div>
          </div>
        @endforeach


      </div>
    </div>
  </div>
@endsection
