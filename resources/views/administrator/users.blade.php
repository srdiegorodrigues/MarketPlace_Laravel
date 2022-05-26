@extends('layouts.administrator')
@section('content')


    <form action="{{route('administrator.users.search')}}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Buscar usuário:" class="form-control" value="{{$filters['filter'] ?? ''}}">
        <button type="submit" class="btn btn-outline-primary">Buscar</button>
    </form>
    <a href="{{route('administrator.report.users')}}" class="btn btn-sm btn-outline-danger float-right btn-keep-buying" target="_blank">
        <i class="fa fa-print" aria-hidden="true"></i>
    </a>


    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Função no sistema</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->mobile_phone}}</td>
                <td>@if($user->role == 'ADMINISTRATOR')
                        Admistrador
                    @elseif($user->role == 'ROLE_OWNER')
                        Dono de loja
                    @else
                        Cliente
                    @endif
                </td>
                <td width="15%">
                    <div class="btn-group">
                        <a href="{{route('administrator.profile.user',['user'=> $user->id])}}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </div>
                    <div class="btn-group">
                        <a href="{{route('user.edit', ['user' => $user->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                    </div>
                    <div class="btn-group">
                        <a href="{{route('administrator.user.remove', ['user' => $user->id])}}" type="submit" class="btn btn-sm btn-danger" data-confirm='Tem certeza de que deseja excluir o usuário selecionado?'><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(isset($filters))
        {{$users->appends($filters)->links()}}
    @else
        {{$users->links()}}
    @endif
@endsection

@section('scripts')
    <script src="{{asset('js/events.js')}}"></script>
@endsection

