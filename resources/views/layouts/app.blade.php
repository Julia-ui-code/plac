<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
  //vai pegar a quantidade de periodos do curso
  use Illuminate\Support\Facades\DB;
  use App\Models\Cursos;
  $num = 0; 
  $dados = DB::table("cursos")  
                ->select('qnt_periodos')
                ->where('id', Auth::user()->curso_id)
                ->get();
  foreach($dados as $item){
      $num = $item->qnt_periodos;
  }
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>PLAC - Planejamento Acadêmico</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light">
      <div class="container">
        
        <img src="/img/plac_logo.png" alt="Logo PLAC" class="img"width="300" height="120">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mt-2 ml-lg-5">
            @auth
                <li class="mr-auto ml-lg-5">
                    <a class="menuzin mr-lg-5" href="{{ url('/home') }}">INÍCIO</a>
                </li>
                <li class="mr-auto ml-lg-5">
                <div class="dropdown show">
                    <a class="dropdown-toggle menuzin mr-lg-5 ml-lg-5" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PERÍODOS
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        @for($id=1; $id <= $num; $id++)
                          <a class="dropdown-item" href="/materias_a/{{$id}}">{{$id}}° Período</a>
                        @endfor
                    </div>
                </div>
                </li>
                <li class="mr-auto ml-lg-5">
                <a class="menuzin mr-lg-5 ml-lg-5" href="/simulador/{{ Auth::user()->curso_id }}">SIMULADOR</a>
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
                   <a href="/perfil/{{ Auth::user()->id }}">
                     <center class="offset-5">
                      <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="User" class="img_usuario" width="40" height="40" style="border-radius:50%;margin-top:10px;">
                      <br>
                      <span class="nome" style="margin-bottom:10px;">{{ Auth::user()->name }}</span>
                      </center>
                    </a>
                    <li class="nav-item">
                      <div class="" aria-labelledby="">
                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                          <img src="/img/logout.png" alt="User" class="img_logout mt-lg-2 offset-7" width="50" height="30" style="margin-bottom:-50px;">
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
    <main>
      @yield('content')
    </main>
  </div>
</body>

</html>
