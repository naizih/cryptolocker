<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cryptolocker</title>
      <!--<link href="{{ mix('css/app.css') }}" rel="stylesheet">-->
      <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <!-- CSS only -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      @yield('style')

      @yield('script')
      
  </head>
  <body class="container">
    
    <!-- header pour utiliser en future -->
    <header></header>

    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-black mt-4 p-2">
      <!-- <a class="navbar-brand" href="/">Cryptolocker</a>-->
      <img src="{{url('img/L.Koesio_50mm_CMJN.svg')}}" class="navbar navbar-brand" alt="" srcset="" id="logo">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('user.accueil') }}"> <i class="fa fa-home"></i> Accueil <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.config') }}"> <i class="fa fa-cog"></i> Configuration</a>
            </li>

            @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.utilisateur') }}"> <i class="fa fa-users"></i> Utilisateurs</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.utilisateur-profile', Auth::user()->id) }}"> <i class="fa fa-user"></i> Profil</a>
            </li>
            @endif



            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}"> Utilisateurs</a>
            </li>
            @endif

        </ul>
      
      
        <div class="navbar-nav ms-auto mb-2 mb-lg-0">
          @guest
            @if (Route::has('login'))
              <div class="d-flex text-white">
                <a href="{{ route('user.home') }}" class="btn text-white"><i class="fa fa-fw fa-sign-in"></i> Se connecter </a>
              </div>
            @endif
          @else
            <div class="d-flex text-white">
              <a form="logout-form" href="{{ route('user.logout') }}" class="btn text-white" 
                    onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();"> 
                    <i class="fa fa-fw fa-sign-out"></i> 
                    Se déconnecter 
              </a>
            </div>

            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          @endguest
        </div>
      </div>
    </nav>



    
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if(\Session::get('message'))
    <div class="alert alert-success">
        <p> {{session::get('message')}}</p>
    </div>
    @endif
    
    @if(\Session::get('fail'))
    <div class="alert alert-danger">
        <p> {{session::get('fail')}}</p>
    </div>
    @endif

    
    
    @yield('content')


    
    <footer class="pt-1">
      <div class="text-center p-4" >
      Copyright &copy; 2022 &nbsp;
      <a class="text-reset fw-bold"  target="_blank" href="https://koesio.com/"> koesio.com</a>
    </div>
    <!-- Copyright -->
        @yield('footer')
    </footer>
  </body>
</html>