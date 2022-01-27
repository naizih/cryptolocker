@extends('templates.template')

@section('content')
<section style="min-height: 40vh">
  <div id="app">
    <!-- utiliser la table accueil-->

    <!-- Pour afficher le tableau de vue.js-->
    <!--<page-accueil></page-accueil>-->
  </div>
  
    <div class="card p-4">
    <h4 class="display-8"> Affichage du fichier Hash </h4>

    @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif

    <!--
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
-->
    <hr class="my-1">


    @if(Auth::user())

    <div class="btn-toolbar p-3">
      <div class="btn-group me-1">
        <a href="choisir_fichier_appat"  class="btn btn-primary">Ajouter le fichier</a>
      </div>

      <!-- form Supprimer -->
      <form action="/check_supprimer" method="POST" id="form">
        @csrf
        <div class="btn-group me-1">
          <input class="btn btn-danger" name="delete" type="submit" value="supprimer">
        </div>
        
        <div class="btn-group me-1">
          <input class="btn btn-success" name="check" type="submit" value="check">
        </div>
      </form>
    </div>  
    @endif

    <table class="table table-striped mt-4 table-bordered rounded">
      <thead class="table-primary text-capitalize text-center">
        <tr>
          @if(Auth::user())
            <th scope="col">Select</th>
          @endif
          <th scope="col">Nom du fichier</th>
          <th scope="col">Chemin</th>
          <th scope="col">Hash</th>
          <th scope="col">Date de creation</th>
          <th scope="col">Date du dernier check</th>
          <th scope="col">Resultat du check</th>
          <th>Dernier check Not_Ok</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($table_fichier_hash))
        @foreach($table_fichier_hash ?? '' as $ligne )
        <tr>
            @if(Auth::user())
              <td>
                <input form="form" name="checkbox[]" type="checkbox" value="{{$ligne->id}}">
              </td>
            @endif
            <td> {{$ligne->nom_de_fichier}}</td>
            <td> {{$ligne->Chemin_de_fichier}} </td>
            <td> {{$ligne->Hash_de_fichier}} </td>
            <td>{{$ligne->created_at}}</td>
            <td>{{$ligne->date_du_dernier_check}}</td>

            @if ($ligne->resultat_de_check == "NOT OK")
            <td class="bg-danger text-light">{{$ligne->resultat_de_check}}</td>
            @else
            <td class="bg-success text-light">{{$ligne->resultat_de_check}}</td>
            @endif
            
            <td>{{$ligne->Trois_check_not_ok}}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
      
    </table>
  </div>
</section>

@endsection



@section('footer')
<script src="{{ mix('js/app.js') }}"></script>
@endsection