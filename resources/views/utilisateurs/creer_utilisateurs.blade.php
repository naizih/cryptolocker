@extends('templates.template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                    <h3> Enregistrement </h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('user.nouveau-utilisateur') }}">
                        @csrf

                        
                        <div class="form-group row mb-2">
                            <label for="inputName" class="col-sm-3 col-form-label">Prénom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="inputName" placeholder="Nom" value="{{old('name')}}">
                            </div>
                        </div>

                        

                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label">Mail</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" value="{{old('email')}}">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Mot de passe</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Confirme mot de passe</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password_confirmation" id="inputConfirmPassword" placeholder="Confirm Password">
                            </div>
                        </div>



                        <div class="form-group row mt-4">
                            <div class="col-sm-10">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-user-plus"></i> Ajouter </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
