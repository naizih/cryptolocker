
@extends('templates.template_config')

@section('config_content')



<div class="card">
        <div class="card-header">
                <h1>Serveur de dossier Partagé</h1>
        </div>

        <div class="card-body">

                <a href="{{ route('user.afficher-ajouter-srv-partage') }}" class="btn btn-success mb-4"> <i class="fa fa-folder"></i> Ajouter Drive partagé </a>

                <table class="table">
                        <thead>
                                <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"> Serveur </th>
                                        <th scope="col"> Utilisateur </th>
                                        <th scope="col"> Dossier partagé </th>
                                        <th scope="col"> partage montée </th>
                                        <th scope="col"> Actions </th>
                                        
                                </tr>
                        </thead>
                        <tbody>
                                @foreach($info_serveur as $index => $info )
                                <tr>
                                        <td> {{ $index+1 }} </td>
                                        <td> {{ $info->ip }} </td>
                                        <td> {{ $info->utilisateur }} </td>
                                        <td>  {{ $info->dossier_partager }} </td>
                                        <td>  {{ $info->partage_monter }} </td>
                                        <td>
                                                <div class="btn-group">
                                                        <form action="{{ route('user.supprimer-srv-partage') }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="id" value="{{$info->id}}">
                                                                <input type="hidden" name="local_mount_path" value="{{$info->partage_monter}}">
                                                                <button type="submit" class="btn btn-danger rounded mx-1"> Supprimer </button>
                                                        </form>
                                                        <a href="{{route('user.edit-srv-partage', $info->id )}}" class="btn btn-primary rounded"> Modifier </a>
                                                </div>
                                        </td>
                                        
                                </tr>
                                @endforeach
                        </tbody>
                </table>

        </div>
</div>
@endsection