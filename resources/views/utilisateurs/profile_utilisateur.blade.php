
@extends('templates.template')

@section('content')

<div class="col-md-10" style="margin: auto;">
    <div class="card p-4">
        <div class="row">

            <div class="col-sm-8 mx-4">
                <h3 class="card-title"> Profile d'utilisateur </h3>
                <p class="card-text"><small class="text-muted"> Information de utilisateur {{$utilisateur->name}} </small> </p>


                <div class="row">
                    <span class="col-sm-4"> <i class="fa fa-user"></i> &nbsp; Nom d'utilisateur :</span>
                    <div class="col-sm">
                    <p class="text-dark">{{$utilisateur->name}}</p>
                    </div>
                </div>


                
                <div class="row">
                    <span class="col-sm-4"><i class="fa fa-envelope"></i> &nbsp; Mail d'utilisateur :</span>
                    <div class="col-sm">
                        <p> <a class="text-decoration-none" href="mailto:{{$utilisateur->email}}"> {{$utilisateur->email}} </a> </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <a href="{{route('user.modifier-utilisateur', $utilisateur->id)}}" class="btn btn-secondary"> Modifier </a>
                    </div>
                </div>

                <!--
                <div class="row pt-3">
                    <span class="col-sm-4 col-form-label"> &nbsp;</span>
                    <div class="col-sm">
                        <a class="btn btn-outline-secondary" href="#"> Modifier </a>
                    </div>
                </div>
                -->

            </div>
        </div>
    </div>
</div>


@endsection
