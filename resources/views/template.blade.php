<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cryptolocker</title>
      <!--<link href="{{ mix('css/app.css') }}" rel="stylesheet">-->
      <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      @yield('style')

      @yield('script')
      
  </head>
  <body class="container">
    
    <!-- header pour utiliser en future -->
    <header> </header>
    
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-4 p-2 rounded">
      <a class="navbar-brand" href="/">Cryptolocker</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/accueil"> Accueil <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/config">Config</a>
          </li>
        </ul>
      </div>
    </nav>

    
    @yield('content')


    
    <footer class="pt-1">
    @yield('footer')
    </footer>
  </body>
</html>