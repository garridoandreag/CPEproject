<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Colegio Pequeñas Estrellas') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
  <script src="https://kit.fontawesome.com/e4f410c930.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
  <!--<script>
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
//  document.getElementById("app").style.marginLeft = "250px";

}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
//  document.getElementById("app").style.marginLeft = "0";

}
</script>-->
  <!-- Fonts -->

  <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">  -->
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="{{ asset('css/font-nunito.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">



</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: var(--navbar-color);">

      <!-- background: rgb(253,29,45);
background: linear-gradient(90deg, rgba(253,29,45,1) 0%, rgba(253,131,31,1) 15%, rgba(252,176,69,1) 33%, rgba(95,167,52,1) 51%, rgba(9,231,240,1) 71%, rgba(131,58,180,1) 90%);-->
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          Colegio Pequeñas Estrellas
          <!--{{ config('app.name', 'Laravel') }}-->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <button type="button" id="sidebarCollapse" class="btn btn-info">
          <i class="fas fa-align-left"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">



          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @else
              <li class="nav-item">
                @include('includes.picture_profile')
              </li>
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  <a class="dropdown-item" href="{{ route('config') }}">
                    Configuración
                  </a>
                </div>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>



    <!--  CORTE DEL EXPERIMENTO -->

    <main class="py-4">
      @yield('content')
    </main>

  </div>
  @yield('script')
  <!--  SIDE BAR   -->
  <div id="sidebar" class="sidenav">
    <ul class="components">

      <li>

        <a href="{{ route('admin.admin') }}">
          <i class="fas fa-users-cog"></i>

          Menú Admón.
        </a>

        <a href="{{ route('student.index') }}">
          <i class="fas fa-user-graduate"></i>

          Estudiantes
        </a>

        <a href="{{ route('tutor.index') }}">
          <i class="fa fa-user"></i>
          Padres
        </a>

        <a href="{{ route('courseprofessor.index') }}">
          <i class="fas fa-chalkboard-teacher"></i>
          Cursos
        </a>

        <a href="{{ route('course.index') }}">
          <i class="fas fa-chalkboard-teacher"></i>
          Cursos
        </a>

        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="menu-dropdown-toggle">
          <i class="fas fa-wallet"></i>
          Colegiatura
        </a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
          <li>
            <a href="#">Page 1</a>
          </li>
          <li>
            <a href="#">Page 2</a>
          </li>
          <li>
            <a href="#">Page 3</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>

  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
        $('#app').toggleClass('active');
      });
    });

  </script>



</body>

</html>
