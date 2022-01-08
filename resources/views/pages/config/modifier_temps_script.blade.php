@extends('template_config')

@section('config_content')
<section>
    <!-- Afficher les erreurs de validation-->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
<div class="card">
    <div class="card-header"> Modifier les valeurs de temps pour checker et envoyer les check au serveur mangement </div>

<!--<div class="card-body">
        <p> Valeur de variable de lancement de script check est:  {{$temps->temps_check}} Minute</p>
        <p> Valeur de variable de envoyer les données au serveur management est:  {{$temps->temps_envoie_server_mgmt}} Minute</p>
    </div> -->

  <form method="POST" action="/update_temps/{{$temps->id}}" class="p-4">
    @method('PUT')
    @csrf

    <div class="form-group row">
        <label for="inputCompany" class="col-sm-3 col-form-label"> Temps de check :</label>
        <div class="col-sm-8">
            <select name="temps_check" id="">
                <option value="{{$temps->temps_check}}">Valeur actuelle est : {{$temps->temps_check}}</option>
                @for ($i = 1; $i < 11;  $i++)
                @if ($i != intval($temps->temps_check))
                <option value="{{$i}}">{{$i}}</option>
                @endif
                @endfor
            </select>     
        </div>
    </div>

    <div class="form-group row">
        <label for="inputCompany" class="col-sm-3 col-form-label"> Temps pour envoyer les données :</label>
        <div class="col-sm-8">
            <select name="server_time"  id="">
                <option value="{{$temps->temps_envoie_server_mgmt}}">Valeur actuelle est : {{$temps->temps_envoie_server_mgmt}}</option>
                @for ($i = 1; $i <= 20; $i++)
                @if ($i != intval($temps->temps_envoie_server_mgmt))
                <option value="{{$i}}">{{$i}}</option>
                @endif
                @endfor
            </select>     
        </div>
    </div>

    <div class="form-group row pt-3">
        <label for="inputEmail" class="col-sm-3 col-form-label"> &nbsp;</label>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-primary">Mise à jour</button>
        </div>
    </div>
</form>
</section>

@endsection