@extends('template')

@section('content')


@php

$url = '';

if(isset($_GET['file'])){
  $url = $url.$_GET['file'];
}

$url_back = explode('/', $url);
array_pop($url_back);

@endphp


<div class="row">
  <div class="alert alert-info mt-3" role="alert">
    <p> <strong> user@cryptolocker:$</strong> &nbsp {{ $url }} </p>
    <p> quand la coleur de dossier passe en vert, c'est indique que c'est un fichier, pour ajouter ce fichier, juste clique sur le fichier </p>
  </div>

  @if ($url && $url != '/' )
  <div class="col-sm-2">
    <div class="card-body">
      <a class="card-title" href="choisir_fichier_appat?file=/{{ end($url_back) }}"><i class="fa fa-folder-o fa-5x" aria-hidden="true"></i></a>
      <p class="card-text"> Back </p>
    </div>
  </div>
  @endif

  @foreach ($files as $file)
    @if($file['filetype'] == 'dir')
    <div class="col-sm-2">
      <div class="card-body">
        <a class="card-title" href="?file={{$url}}/{{$file['name']}}"><i class="fa fa-folder-o fa-5x" aria-hidden="true"></i></a>
        <p class="card-text"> {{ $file['name'] }} </p>

      </div>  
    </div>
    @else
    <div class="col-sm-2">
      <div class="card-body">
        <form action="ajouter-nouveau-fichier" method="POST">
          @csrf
          <input type="hidden" name="nom_de_fichier" value="{{$file['name']}}">
          <input type="hidden" name="chemin_de_fichier" value="{{$file['path']}}">
          <button type="submit" class="alert alert-success"> <i class="fa fa-folder-o fa-5x" aria-hidden="true"></i> </button>
          <p class="card-text"> {{ $file['name']}} </p>
        </form>
      </div>
    </div>
      
    @endif
  @endforeach
</div>

@endsection