
@extends('template')

@section('content')
<section class="container pt-4">

<div class="card">
  <div class="card-header">
    Formulaire pour modifier le client
  </div>

  <form method="POST" action="/modifier_client/{{$info_client->id}}">
    @method('PUT')
    @csrf

    <div class="input_style my-4 p-4">
      <div class="form-group row">
        <label for="inputCompany" class="col-sm-2 col-form-label"> <i class="fa fa-building"></i> &nbsp; Company Name :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="nom_entreprise" id="inputCompany" value="{{$info_client->nom_entreprise}}">
        </div>
      </div>
      
          <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label"> <i class="fa fa-user-circle"></i> &nbsp; Client Name :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nom_client" id="inputName" value="{{$info_client->nom_client}}">
            </div>
          </div>
      
          <div class="form-group row">
            <label for="inputMobile" class="col-sm-2 col-form-label"> <i class="fa fa-phone"></i> &nbsp; Mobile N° :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="mobile"  id="inputMobile" value="{{$info_client->mobile}}">
            </div>
          </div>
      
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label"><i class="fa fa-envelope"></i> &nbsp; Email Adresse :</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" name="email" id="inputEmail" value="{{$info_client->email}}">
            </div>
          </div>
          <div class="form-group row pt-3">
            <label for="inputEmail" class="col-sm-2 col-form-label"> &nbsp;</label>
            <div class="col-sm-8">
              <button type="submit" class="btn btn-primary">Mise à jour</button>
            </div>
          </div>
        </div>
    </form>

</div>
</div>


</section>
@endsection

