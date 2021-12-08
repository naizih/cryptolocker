
@extends('template')







@section('content')
<section id="page-accueil">

    <div id="app">
      <!-- import la page AccueilTable -->
      <!--<table-component> </table-component>-->
      
      <!-- utiliser la table accueil-->
      <page-accueil></page-accueil>

    </div>


</section>
@endsection




@section('script')

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

@endsection


