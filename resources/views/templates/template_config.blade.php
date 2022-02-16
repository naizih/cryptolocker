@extends('templates.template')

@section('content')

<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light mt-4">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'user.config' ? 'active text-white bg-dark bg-gradient' : 'text-dark' }}" aria-controls="home" href="{{route('user.config')}}" role="tab" data-toggle="tab"> Info Client </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'user.config-serv-mgmt' ? 'active text-white bg-dark bg-gradient' : 'text-dark' }}" aria-controls="home" href="{{route('user.config-serv-mgmt')}}" role="tab" data-toggle="tab"> Info du serveur Mgmt </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'user.config-script-time' ? 'active text-white bg-dark bg-gradient' : 'text-dark' }}" aria-controls="home" href="{{route('user.config-script-time')}}" role="tab" data-toggle="tab"> Temps de scripts </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::current()->getName() == 'user.config-info-srv-partage' ? 'active text-white bg-dark bg-gradient' : 'text-dark' }}" aria-controls="home" href="{{route('user.config-info-srv-partage')}}" role="tab" data-toggle="tab"> Info du serveur partage </a>
            </li>
            
        </ul>
    </div>
</nav>

<!--
    @if(\Session::get('message'))
    <div class="alert alert-success">
        <p> {{session::get('message')}}</p>
        
    </div>
    @elseif(\Session::get('error'))
    <div class="alert alert-danger">
        {{session::get('error')}}
    </div>
    @endif

-->


@yield('config_content')

@endsection