

@extends('templates.template')

@section('content')



<div class="card my-4">
    <div class="card-header">
        <h4> Ajouter nouveau partage </h4>
    </div>

    <div class="card-body">

    <form action="{{ route('user.ajouter-srv-partage')}}" method="post" id="srv-partage-ajouter">
        @csrf
        
        <div class="form-group">
            <label for="exampleInputIP">Adresse IP/Nom de domaine </label>
            <input type="text" class="form-control" id="exampleInputIP" aria-describedby="IPHelp" placeholder="Adresse IP" name="ip" value="{{ old('ip') }}">
            <small id="IPHelp" class="form-text text-muted"> Ecrire l'adresse IP ou nom de domain de serveur de dossier partage.</small>
        </div>


        <div class="form-group">
            <label for="exampleInputuser">Compte</label>
            <input type="text" class="form-control" id="exampleInputuser" placeholder="Nom d'utilisateur" name="user" value="{{ old('user') }}">
        </div>


        <div class="form-group">
            <label for="exampleInputSharedFile">Dossier partagé</label>
            <input type="text" class="form-control" id="exampleInputSharedFile" placeholder="Nom de dossier partagé" name="shared_folder" value="{{ old('shared_folder') }}">
        </div>

        <div class="form-group">
            <label for="exampleInputMountPath"> Dossier locale </label>
            <input type="text"  class="form-control" id="exampleInputMountPath" aria-describedby="partage_name_Help" placeholder="Nom de dossier où partage va monter" name="local_mount_path" value="{{ old('local_mount_path') }}">
            <small id="partage_name_Help" class="form-text text-muted"> on crée un dossier locale est on l'associe avec le dossier partagé, le dossier de montage de partage par default est /mnt .</small>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="{{old('password')}}">
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-success"> Ajouter </button>
            <a href="/config/srv-partage" class="btn btn-secondary"> Cancel </a>
        </div>

    </form>


    </div>
</div>



@endsection