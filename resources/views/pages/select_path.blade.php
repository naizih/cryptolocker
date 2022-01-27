
@extends('templates.template')

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
    <div class="alert alert-primary mt-3" role="alert">
        <p> user@cryptolocker:$ &nbsp {{ $url }} </p>
    </div>
    <p> Cliquer sur le boutton pour select le chemin de fichier. </p>
    <div class="col-sm-2">
        <div class="card-body">
            <a class="card-title" href="select_file?file=/{{ end($url_back) }}"><i class="fa fa-folder-o fa-5x" aria-hidden="true"></i></a>
            <p class="card-text"> Back </p>
        </div>
    </div>

    @foreach ($files as $file)
    @if($file['filetype'] == 'dir')
    <div class="col-sm-2">
        <div class="card-body">
            <a class="card-title" href="?file={{$url}}/{{$file['name']}}"><i class="fa fa-folder-o fa-5x" aria-hidden="true"></i></a>
            <p class="card-text"> {{ $file['name'] }} </p>

    {{ var_dump($file['filetype']) }}
        </div>  
    </div>
    @else
    <div class="col-sm-2">
        <div class="card-body">
            <form action="select_file" method="POST">
                <input type="hidden" name="chemni_de_fichier" value="{{$file['name']}}">
                <input type="hidden" name="nom_de_fichier" value="{{$file['path']}}">
                <a class="submit" href="select_file"><i class="fa fa-folder-o fa-5x" aria-hidden="true"></i></a>
                <p class="card-text"> {{ $file['name']}} </p>
            </form>
        </div>
    </div>
    
    @endif
    @endforeach

<!--
    @foreach ($files as $file)
    <div class="col-sm-2">
        <div class="card-body">
            
            
        </div>
    </div>
    @endforeach
-->
    
</div>

<div class="row">
    <div class="mb-3">
      <input type="submit" value="Select" class="btn btn-primary">
    </div>
    </div>
</div>








@endsection