@extends('layouts.manager')
@section('content')
<div class="layout-manager">
    @if(!$store)
        <h2>Seja bem-vindo(a) à sua loja virtual no Site Marketplace!</h2>
        <hr>

        <p class="text-danger">
            Você agora fazer parte da nossa rede de lojistas.
            Não perca tempo, crie agora mesmo sua Loja Virtual, em nosso site, e anuncie seus produtos.
        </p>


        <a href="{{route('manager.stores.create')}}" class="btn btn-success">Criar Loja</a>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Loja</th>
                <th>Total de produtos</th>
                <th>Ações</th>
            </tr>
            <tbody>
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->name}}</td>
                <td>{{$store->products->count()}}</td>

                <td>
                    <div class="btn-group">
                        <a href="{{route('manager.stores.edit', ['store'=> $store->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                    </div>
                    <div class="btn-group">
                        <a href="{{route('manager.stores.remove', ['store'=> $store->id])}}"  data-confirm='Tem certeza de que deseja excluir a sua loja?' type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>

                </td>
            </tr>
            </tbody>
            </thead>
        </table>

    @endif
</div>

@endsection

@section('scripts')
    <script src="{{asset('js/events.js')}}"></script>
@endsection
