@extends('templates.template_config')

@section('config_content')


<!-- pour configurer apres le temps de check auto-->

<div class="card">
    <div class="card-header">
        <h2 class="display-8">Paramètres du temps</h2>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="inputName" class="col-sm-3 col-form-label"> Temps check </label>
            <div class="col-sm-8">
                <p> Lancement de script check tous les  <strong>
                    @if (!empty($temps['temps_check']))
                    <span class="text-primary"> {{$temps['temps_check']}} </span>
                    @else
                    <select form="ajoute_temps_script" name="temps_check" id="">
                        @for ($i = 1; $i < 11;  $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>     
                    @endif
                </strong> minutes.</p>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-3 col-form-label"> Envoyer les données au serveur mgmt</label>
            <div class="col-sm-8">
                <p> Envoyer les informations de verification au serveur maangement tous les <strong>
                    @if (!empty($temps['temps_envoie_server_mgmt']))
                    <span class="text-primary"> {{$temps['temps_envoie_server_mgmt']}} </span>
                    @else
                    <select form="ajoute_temps_script" name="temps_envoie_server_mgmt" id="">
                        @for ($i = 1; $i < 11;  $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select> 
                    @endif
                </strong> minutes.</p>
                <!-- <p class="alert alert-danger"> <small> Il envoie alerte au serveur management, si il y a 3 fois plus de different entre le temps actuelle et le temps de dernier check</small></p> -->
            </div>
        </div> 


        <div class="form-group row pt-3">
            <label for="inputEmail" class="col-sm-3 col-form-label"> &nbsp;</label>
            <div class="col-sm-8">
                @if (!empty($temps['id']))
                <a class="btn btn-outline-secondary" href="/modifier_temps/{{$temps['id']}}/modifier"> Modifier </a>
                @else
                <button form="ajoute_temps_script" type="submit" class="btn btn-primary">Ajouter</button>
                @endif
            </div>
        </div>


        <!-- Form d'ajouter la valeur des variables temps -->
        <form action="/config/ajouter_temps_script" method="POST" id="ajoute_temps_script">
            @csrf
        </form>
        
    </div>
</div>


@endsection

