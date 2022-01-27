

@extends('templates.template')

@section('content')



<div class="card my-4">
    <div class="card-header">
        <h4> Modifier partage </h4>
    </div>


    <div class="card-body">
        <form action="{{ route('user.update-srv-partage', $info_partage->id )}}" method="post" id="srv-partage-ajouter">
            @csrf
            
            <div class="form-group">
                <label for="exampleInputIP">Adresse IP/Nom de domaine </label>
                <input type="text" class="form-control" id="exampleInputIP" aria-describedby="IPHelp"  name="ip" value="{{ $info_partage->ip }}">
                <small id="IPHelp" class="form-text text-muted"> Ecrire l'adresse IP ou nom de domain de serveur de dossier partage.</small>
            </div>


            <div class="form-group">
                <label for="exampleInputuser">Compte</label>
                <input type="text" class="form-control" id="exampleInputuser" name="user" value="{{ $info_partage->utilisateur }}">
            </div>


            <div class="form-group">
                <label for="exampleInputSharedFile">Dossier partagé</label>
                <input type="text" class="form-control" id="exampleInputSharedFile"  name="shared_folder" value="{{ $info_partage->dossier_partager }}">
            </div>

            <div class="form-group">
                <label for="exampleInputMountPath">Partage montée </label>
                <input type="text"  class="form-control" id="exampleInputMountPath" name="local_mount_path" value="{{ $info_partage->partage_monter }}">
                
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="{{ $info_partage->password }}">
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary"> Mis à jour </button>
                <a href="/config/srv-partage" class="btn btn-secondary"> Cancel </a>
            </div>

        </form>
    </div>
</div>



@endsection