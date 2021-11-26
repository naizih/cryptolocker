
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

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <section id="page-accueil">

        <h1>Bienvenue à la Page d'Accueil - Client </h1>
        <hr>

        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Chemin</th>
      <th scope="col">Hash</th>
      <th scope="col">Date de creation</th>
    </tr>
  </thead>
  <tbody>
    @foreach($fichier_hash ?? '' as $hash)
    <tr>
        <td> {{$hash->id}}</td>
        <td> {{$hash->Chemin_de_fichier}} </td>
        <td> {{$hash->Hash_de_fichier}} </td>
        <td>{{$hash->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<hr>
<h4>Upload a File</h4>

<form action="/fichier-appat" method="post" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="formFile" class="form-label">Choisir un fichier appat</label>
    <input class="form-control" type="file" id="formFile" name="fichier">
  </div>
  <input type="submit" value="Ajouter" class="btn btn-success">
  <input type="hidden" id="file-content">
</form>

<hr>
<h4>Start Vue js App</h4>


        <div id="app">            
            <page-accueil></page-accueil>
        </div>

        
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