@extends('layouts.administrator')


@section('content')
    @include('flash::message')
    <form action="{{route('administrator.products.search')}}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Buscar produto:" class="form-control" value="{{$filters['filter'] ?? ''}}">
        <button type="submit" class="btn btn-outline-primary">Buscar</button>
    </form>

    <a href="{{route('administrator.report.products')}}" class="btn btn-sm btn-outline-danger float-right btn-keep-buying" target="_blank">
        <i class="fa fa-print" aria-hidden="true"></i>
    </a>



<table class="table table-striped">
    <thead>
    <tr>
        <th>Nome do produto</th>
        <th>Preço</th>
        <th>Loja</th>
        <th>Categorias</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @forelse($products as $p)
        @if($p->store)
        <tr>

            <td>{{$p->name}}</td>
            <td>R$ {{number_format($p->price, 2, ',','.')}}</td>
            <td>@if($p->store->name !== [])
                    {{$p->store->name}}
                @else
                    Produto sem loja
                @endif

            </td>
            <td>@foreach($p->categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach </td>
            <td>
                <div class="btn-group">
                    <a href="{{route('product.single',['slug'=>$p->slug])}}" target="_blank" class="btn-sm btn-success">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{route('manager.products.edit', ['product'=> $p->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square" aria-hidden="true" alt="Editar"></i></a>
                </div>
                <div class="btn-group">
                    <a href="{{route('manager.products.remove', ['product'=> $p->id])}}" type="submit" target="_blank" class="btn btn-sm btn-danger" data-confirm='Tem certeza de que deseja excluir o item selecionado?'><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
            </td>
        </tr>
        @endif
    @empty
        <div class="alert alert-warning">Ainda não há Categorias cadastradas no Marketplace!</div>
    @endforelse
    </tbody>
</table>
    @if(isset($filters))
        {{$products->appends($filters)->links()}}
    @else
        {{$products->links()}}
    @endif

@endsection
@section('scripts')

    <script src="{{asset('js/events.js')}}"></script>
@endsection


