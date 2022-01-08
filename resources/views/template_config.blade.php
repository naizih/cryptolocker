@extends('template')

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection

@section('content')

<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light mt-4">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link" href="/config"> Info Client <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/config/info_ser_mgmt">Info du serveur Mgmt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/config/variable_temps_script">Script Time</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/config/info_ser_partage">Info du serveur partage</a>
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