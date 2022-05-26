@extends('layouts.manager')

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('manager.notifications.read.all')}}" class="btn btn-lg btn-success">Marcar todas como lidas!</a>
            <br>
            <br>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Notificação</th>
            <th>Criado em: </th>
            <th>Ações</th>



        </tr>
        <tbody>
            @forelse($unreadNotifications as $n)
                <tr>
                    <td>{{$n->data['message']}}</td>
                    <td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('manager.notifications.read',['notification'=>$n->id])}}" class="btn btn-sm btn-primary">Marcar como lida</a>
                        </div>
                        <div class="btn-group">
                            <a href="{{route('manager.orders.my')}}" class="btn btn-sm btn-success">Ver pedido</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-warning">Você não recebeu nenhuma nova notificação!</div>
                    </td>

                </tr>
            @endforelse
        </tbody>
        </thead>
    </table>
@endsection
