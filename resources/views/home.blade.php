@extends('layouts.app')

@section('content')
  @inject('announcements','App\Services\Announcements')

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card border-primary">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
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
