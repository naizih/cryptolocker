
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptolocker</title>

    <!--<link href="{{ mix('css/app.css') }}" rel="stylesheet">-->

    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>
<body>
    <section id="page-accueil">

    <div id="app">
      <table-component> </table-component>
      <hr>
      <page-accueil></page-accueil>
    </div>









        <h1>Bienvenue à la Page d'Accueil - Client </h1>
        <hr>

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
    @foreach($table_fichier_hash ?? '' as $ligne)
    <tr>
        <td> {{$ligne->id}}</td>
        <td> {{$ligne->nom_de_fichier}}</td>
        <td> {{$ligne->Chemin_de_fichier}} </td>
        <td> {{$ligne->Hash_de_fichier}} </td>
        <td>{{$ligne->created_at}}</td>
        <td>
          <form action="/suppri/{{$ligne->id}}" method="post">
            @method('DELETE')
            @csrf
          <div>
            <!--<input type="checkbox" id="delete" name="delete[]" value="{{$ligne->id}}">-->
            <input type="submit" value="Delete">
          </div>
          <div>
          </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>

<hr>
<h4>Upload a File</h4>

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

<hr>




        
<script src="{{ mix('js/app.js') }}"></script>

</section>
   
<script>

function readSingleFile(e) {
  var file = e.target.files[0];
  if (!file) {
    return;
  }
  var reader = new FileReader();
  reader.onload = function(e) {
    var contents = e.target.result;
    // Display file content
    displayContents(contents);
  };
  reader.readAsText(file);
}
 
function displayContents(contents) {
  var element = document.getElementById('file-content');
  element.innerHTML = contents;
}
 
document.getElementById('fichier').addEventListener('change', readSingleFile, false);

</script>


</body>
</html>