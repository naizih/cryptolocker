@extends('templates.template_config')

@section('config_content')
<div class="my-2">
        <h2 class="display-8">Information de NAS</h2>
        <hr>
        <h5>static</h5>
        <p> serveur de partage:    <span class="text-success"> 192.168.176.2 </span></p>
        <p> dossier partagé:        <span class="text-success">projetm12021</span></p>
        <p> partage montée sur:  <span class="text-success">/mnt/partage1</span></p>

</div>
@endsection