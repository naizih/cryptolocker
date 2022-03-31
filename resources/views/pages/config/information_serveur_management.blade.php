@extends('templates.template_config')
@section('config_content')
<section class="card">
    <div class="card-header">
        <h2 class="display-8">Information du serveur management</h2>
    </div>
    <div class="card-body">

        <div class="btn-toolbar mb-3">
            <div class="btn-group">
                <form action="/connected" method="get">
                    @csrf
                    <button type="submit" name="connected" class="btn btn-primary">connected ?</div>
                    <input type = "hidden" name = "_token" value="{{Session::token() }}">
                </form>
            </div>
        </div>


        <div class="input_style" id="config_server_mgmt">
            <form action="ajouter_info_serveur" method="POST">
                    @csrf
                <div class="form-group row">
                    <label for="inputCompany" class="col-sm-2 col-form-label"> IP/DNS :</label>
                    <div class="col-sm-8">
                        @if (!empty($info_serveur['IP_DNS']))
                        <p>{{$info_serveur['IP_DNS']}}</p>
                        @else
                        <input type="text" class="form-control" name="adresse_ip" id="inputCompany" placeholder="Adresse IP/DNS">
                        @endif
                    </div>
                </div>
                
                <div class="form-group row pt-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label"> &nbsp;</label>
                    <div class="col-sm-8">
                        @if (!empty($info_serveur['IP_DNS']))
                        <a class="btn btn-outline-secondary" href="/modifier_serveur_info/{{$info_serveur['id']}}/modifier"> Modifier </a>
                        @else
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Fin d'information de serveur-->
</section>

@endsection
