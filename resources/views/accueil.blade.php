@extends('template')

@section('content')
<section>
  <div id="app">
    <!-- utiliser la table accueil-->
    <page-accueil></page-accueil>
  </div>
</section>
@endsection


@section('footer')

<div class="card-footer text-muted card flex-item">
  <div class="jumbotron">
    
    <!-- class pour tous les input-->

    @if($information_client->count() > 0)
    @foreach($information_client as $info)
    <h2 class="display-8">Bonjour Monsieur. {{$info->nom_client}}</h2>
    <hr class="my-4">
    <div class="input_style">
      <div class="form-group row">
        <label for="inputCompany" class="col-sm-2 col-form-label"> <i class="fa fa-building"></i> &nbsp; Company Name :</label>
        <div class="col-sm-8">
          <p class="text-dark">{{$info->nom_entreprise}}</p>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputName" class="col-sm-2 col-form-label"> <i class="fa fa-user-circle"></i> &nbsp; Client Name :</label>
        <div class="col-sm-8">
          <p class="text-dark">{{$info->nom_client}}</p>
        </div>
      </div>
      
          <div class="form-group row">
            <label for="inputMobile" class="col-sm-2 col-form-label"> <i class="fa fa-phone"></i> &nbsp; Mobile N° :</label>
            <div class="col-sm-8">
            <p class="text-dark">{{$info->mobile}}</p>
            </div>
          </div>
      
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label"><i class="fa fa-envelope"></i> &nbsp; Email Adresse :</label>
            <div class="col-sm-8">
            <p class="text-dark">{{$info->email}}</p>
            </div>
          </div>
        
          <div class="form-group row pt-3">
            <label for="inputEmail" class="col-sm-2 col-form-label"> &nbsp;</label>
            <div class="col-sm-8">
              <a class="btn btn-outline-secondary" href="/modifier_client/{{$info->id}}/modifier"> Modifier </a>
            </div>
          </div>

        </div>
        @endforeach
    @else
    <h2 class="display-8">Information de client</h2>
      <p> saisir les information de client.</p>
      <hr class="my-4">
      <form method="POST" action="/ajouter-client">
        @csrf
        <div class="input_style">
          <div class="form-group row">
            <label for="inputCompany" class="col-sm-2 col-form-label"> <i class="fa fa-building"></i> &nbsp; Company Name :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nom_entreprise" id="inputCompany" placeholder="Company name">
            </div>
          </div>
      
          <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label"> <i class="fa fa-user-circle"></i> &nbsp; Client Name :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nom_client" id="inputName" placeholder="Cleint name">
            </div>
          </div>
      
          <div class="form-group row">
            <label for="inputMobile" class="col-sm-2 col-form-label"> <i class="fa fa-phone"></i> &nbsp; Mobile N° :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="mobile"  id="inputMobile" placeholder="Mobile number">
            </div>
          </div>
      
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label"><i class="fa fa-envelope"></i> &nbsp; Email Adresse :</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email @">
            </div>
          </div>
          <div class="form-group row pt-3">
            <label for="inputEmail" class="col-sm-2 col-form-label"> &nbsp;</label>
            <div class="col-sm-8">
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
          </div>
        </div> 
    </form>
    @endif

  </div>
</div>
@endsection

@section('script')
<script src="{{ mix('js/app.js') }}"></script>
@endsection