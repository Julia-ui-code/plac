<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>PLAC - Planejamento Acadêmico</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light">
      <div class="container">

        <img src="../../img/plac_logo.png" alt="Logo PLAC" class="img" width="300" height="120">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mt-2 ml-lg-5">
            @auth
            <li class="mr-auto ml-lg-5">
              <a class="menuzin mr-lg-5" href="{{ route('home-admin') }}">INÍCIO</a>
            </li>
            <li class="mr-auto ml-lg-5">
              <div class="dropdown show">
                <a class="dropdown-toggle menuzin mr-lg-5 ml-lg-5" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  GERENCIAR
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{{route('curso')}}">Cursos</a>
                  <a class="dropdown-item" href="{{route('eixos')}}">Eixos</a>
                  <a class="dropdown-item" href="{{ url('materias') }}">Matérias</a>
                </div>
              </div>
            </li>
            <li class="mr-auto ml-lg-5">
              <a class="menuzin mr-lg-5 ml-lg-5" href="{{ route('alunos') }}">ALUNOS</a>
            </li>
            @endauth
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest

            @if (Route::has('register'))

            @endif
            @else
            <div class="row">
                    <a href="/perfiladm/{{ Auth::user()->id }}">
                      <center class="offset-5">
                      <img src="../../uploads/avatars/{{ Auth::user()->avatar }}" alt="User" class="img_usuario" width="40" height="40" style="border-radius:50%;margin-top:10px;">
                      <br>
                      <span class="nome" style="margin-bottom:10px;">{{ Auth::user()->name }}</span>
                      </center>
                    </a>
                    <li class="nav-item">
                      <div class="" aria-labelledby="">
                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                          <img src="../../img/logout.png" alt="User" class="img_logout mt-lg-2 offset-7" width="50" height="30" style="margin-bottom:-50px;">
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                        </form>
                      </div>
                    </li>
            </div>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <hr style="height:1px;width:100%;border-width:0;color:gray;background-color:#1C40C3;margin-top:-5px;">
    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>