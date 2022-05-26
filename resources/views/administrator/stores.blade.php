@extends('layouts.administrator')

@section('content')

    <form action="{{route('administrator.stores.search')}}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Buscar loja:" class="form-control" value="{{$filters['filter'] ?? ''}}">
        <button type="submit" class="btn btn-outline-primary">Buscar</button>
    </form>
    <a href="{{route('administrator.report.stores')}}" class="btn btn-sm btn-outline-danger float-right btn-keep-buying" target="_blank">
        <i class="fa fa-print" aria-hidden="true"></i>
    </a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Loja</th>
            <th>Dono</th>
            <th>Total de produtos</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>

            @foreach($stores as $store)
                    <tr>
                        <td>{{$store->name}}</td>
                        <td>{{$store->user->name}}</td>
                        <td>{{$store->products->count()}}</td>
                        <td>
                            <div class="btn-group">

                                <a href="{{route('store.single',['slug'=> $store->slug])}}" class="btn btn-sm btn-success col-md-auto">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="{{route('manager.stores.edit', ['store'=> $store->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                            </div>
                            <div class="btn-group">
                                <a href="{{route('manager.stores.remove', ['store'=> $store->id])}}"class="btn btn-sm btn-danger" data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
            @endforeach
        </tbody>

    </table>
    @if(isset($filters))
        {{$stores->appends($filters)->links()}}
    @else
        {{$stores->links()}}
    @endif

@endsection
@section('scripts')
    <script src="{{asset('js/events.js')}}"></script>
@endsection
