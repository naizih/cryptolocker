@extends('template')

@section('content')
<section style="min-height: 40vh" class="container">
  <div id="app">
    <!-- utiliser la table accueil-->
    <page-accueil></page-accueil>
  </div>



<div class="card p-4 my-2">
  <h4 class="display-8">Tableau</h4>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">N°</th>
        <th scope="col">Nom de fichier</th>
        <th scope="col">Chemin</th>
        <th scope="col">Hash</th>
        <th scope="col">Date de creation</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($table_fichier_hash))
      @foreach($table_fichier_hash ?? '' as $index => $ligne )
      <tr>
          <td> {{$index+1}}</td>
          <td> {{$ligne->nom_de_fichier}}</td>
          <td> {{$ligne->Chemin_de_fichier}} </td>
          <td> {{$ligne->Hash_de_fichier}} </td>
          <td>{{$ligne->created_at}}</td>
          <td>
            <form action="/delete/{{$ligne->id}}" method="post">
              @method('DELETE')
              @csrf
              <div>
                <input type="submit" value="Delete">
              </div>
            </form>
          </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
</div>

  <!-- Formulaire ajouter fichier appat-->
<div class="card p-4 my-2">
<h4 class="display-8">Upload a File</h4>
<hr class="my-4">
<form action="/fichier-appat" method="post" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="chemin" class="form-label">Copie la Chemin de fichier</label>
    <input class="form-control" type="text" id="chemin" name="chemin">
  </div>
  <div class="mb-3">
    <label for="formFile" class="form-label">Choisir un fichier appat</label>
    <input class="form-control" type="file" id="formFile" name="fichier">
  </div>
  <input type="submit" value="Ajouter" class="btn btn-primary">
</form>
</div>
<!-- Fin de Formulaire d'ajouter un nouveau fichier-->



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