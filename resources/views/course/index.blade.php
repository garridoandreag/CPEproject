@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/app.js') }}"></script>
  <style>
    .status {
      cursor: pointer;
    }

  </style>
  <div class="container">
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Cursos</div>
        </div>
        <div class="card-body">
          <div class="col-md-12">
            <a href="{{ action('CourseController@create') }}" class="btn btn-primary">Nuevo </a>
          </div>
          <div class="table"></div>
          <table>
            <thead>
              <tr>
                <td>Name</td>
                <td>Estado</td>
                <td>Opciones</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($courses as $course)
                <tr>
                  <td>
                    {{ $course->name }}
                  </td>
                  <td>
                    @if ($course->status == 'INACTIVO')
                      <span id="status{{ $course->id }}" onclick="changeStatus({{ $course->id }})"
                        class="status badge badge-danger">
                      <span
                        id="status{{$course->id}}" onclick="changeStatus({{$course->id}})" class="status badge badge-danger">
                      <span id="status{{$course->id}}" onclick="changeStatus({{$course->id}})" class="status badge badge-danger">
                        {{ $course->status }}
                      </span>
                    @else
                      <span id="status{{ $course->id }}" onclick="changeStatus({{ $course->id }})"
                        class="status badge badge-success">
                        {{ $course->status }}
                      </span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ action('CourseController@detail', ['id' => $course->id]) }}">
                      Edit
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    async function changeStatus(id) {
      try {
        const badge = $(`#status${id}`);
        let status = badge.text().trim();

        status = await axios.post('/course/status', {
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
