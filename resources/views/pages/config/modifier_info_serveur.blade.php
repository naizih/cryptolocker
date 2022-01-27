@extends('templates.template_config')

@section('config_content')
<section>

    
<div class="card">
  <div class="card-header"> Modifier les information de serveur </div>
  <form method="POST" action="/modifier_serveur_info/{{$info_serveur->id}}" class="p-4">
    @method('PUT')
    @csrf

    <div class="form-group row">
        <label for="inputCompany" class="col-sm-2 col-form-label"> IP adresse :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="adresse_ip" id="inputCompany" value="{{$info_serveur->IP}}">        
        </div>
    </div>
            
    <div class="form-group row pt-3">
        <label for="inputEmail" class="col-sm-2 col-form-label"> &nbsp;</label>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-primary">Mise à jour</button>
        </div>
    </div>

</form>
</section>

@endsection