<!-- utilisation de template_config -->
@extends('templates.template_config')

@section('config_content')
<section class="card p-3">
    <div class="btn-toolbar mb-3">
      <div class="btn-group">
          <form action="/connected" method="get">
              @csrf
            <button type="submit" name="connected" class="btn btn-primary">connected ?</div>
            <input type = "hidden" name = "_token" value="{{Session::token() }}">
          </form>
      </div>
    </div>

    @include('pages.config.information_serveur_client')
</section>
@endsection