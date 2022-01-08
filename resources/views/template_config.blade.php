@extends('template')

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection

@section('content')

<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light mt-4">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'config' ? 'active text-primary' : 'text-dark' }}" aria-controls="home" href="{{route('config')}}" role="tab" data-toggle="tab"> Info Client </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'config-serv-mgmt' ? 'active text-primary ' : 'text-dark' }}" aria-controls="home" href="{{route('config-serv-mgmt')}}" role="tab" data-toggle="tab"> Info du serveur Mgmt </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'config-script-time' ? 'active text-primary ' : 'text-dark' }}" aria-controls="home" href="{{route('config-script-time')}}" role="tab" data-toggle="tab"> Temps de scripts </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'config-info-srv-partage' ? 'active text-primary ' : 'text-dark' }}" aria-controls="home" href="{{route('config-info-srv-partage')}}" role="tab" data-toggle="tab"> Info du serveur partage </a>
            </li>
            
        </ul>
    </div>
</nav>

    @if(\Session::get('message'))
    <div class="alert alert-success">
        <p> {{session::get('message')}}</p>
        
    </div>
    @elseif(\Session::get('error'))
    <div class="alert alert-danger">
        {{session::get('error')}}
    </div>
    @endif


@yield('config_content')

@endsection