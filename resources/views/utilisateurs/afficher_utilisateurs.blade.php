
@extends('templates.template')

@section('content')

    <div class="card p-4">

        <div>            
            <a href="{{route('user.utilisateur-register')}}" class="btn btn-success"> <i class="fa fa-user-plus"> </i> &nbsp; Ajouter utilisateur </a>
        </div>
        <div class="table-responsive my-2  bg-white border rounded">     
            <h2 class="px-2 py-3"> Utilisateurs </h2>
            <table class="table table-bordered table-striped">
                <thead class="align-middle">
                    <tr class="bg-dark text-white">
                        <th scope="col"> Nom </th>
                        <th scope="col"> Mail </th>
                        <th scope="col"> Actions </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user )
                    <tr>
                        <td> {{ $user->name }} </td>
                        <td> <a href="mailto:{{$user->email}}" class="text-decoration-none"> {{ $user->email }} </a> </td>


                        <td class="text-center">
                            
                            <div class="btn-group">
                                
                                <a href="{{route('user.modifier-utilisateur', $user->id) }}" class="btn btn-primary rounded mx-1"> <i class="fa fa-edit"></i> Modifier </a>


                                <form id="rejeter-form" action="{{ route('user.utilisateur-delete' , $user->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button class="btn btn-danger" ><i class="fa fa-trash"></i> Supprimer </button> 
                                </form>

                            </div>
                            <!--<a href="user_info/{{$user->id}}/edit" class="btn btn-primary"> <i class="fa fa-edit"></i> {{ __('Edit')}} </a>-->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End of responsive table -->
    </div>


@endsection
