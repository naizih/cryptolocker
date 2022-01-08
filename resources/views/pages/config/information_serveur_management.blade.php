@extends('template_config')

@section('config_content')
<section class="card p-3">
    <h2 class="display-8">Information du serveur management</h2>
        <hr class="my-2">
        <div class="input_style" id="config_server_mgmt">
        <form action="ajouter_info_serveur" method="POST">
                @csrf
            <div class="form-group row">
                <label for="inputCompany" class="col-sm-2 col-form-label"> IP adresse :</label>
                <div class="col-sm-8">
                    @if (!empty($info_serveur['IP']))
                    <p>{{$info_serveur['IP']}}</p>
                    @else
                    <input type="text" class="form-control" name="adresse_ip" id="inputCompany" placeholder="@ IP">
                    @endif
                </div>
            </div>
            
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label"> DNS name :</label>
                <div class="col-sm-8">
                    @if (!empty($info_serveur['IP']))
                    <p>{{$info_serveur['domain_name']}}</p>
                    @else
                    <input type="text" class="form-control" name="DNS" id="inputCompany" placeholder="Nom de doamine">
                    @endif
                </div>
            </div> 
            <div class="form-group row pt-3">
                <label for="inputEmail" class="col-sm-2 col-form-label"> &nbsp;</label>
                <div class="col-sm-8">
                    @if (!empty($info_serveur['IP']))
                    <a class="btn btn-outline-secondary" href="/modifier_serveur_info/{{$info_serveur['id']}}/modifier"> Modifier </a>
                    @else
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <!-- Fin d'information de serveur-->
</section>

@endsection