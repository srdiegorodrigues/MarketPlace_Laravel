@extends('layouts.manager')
@section('content')
    <div class="layout-manager">
        <a href="{{route('manager.products.create')}}" class="btn btn-primary btn-keep-buying">Adicionar Produto</a>

    <div class="btn-group float-right">
        <a href="{{route('manager.pdf.products')}}" class="btn btn-sm btn-outline-danger float-right btn-keep-buying" target="_blank">
            <i class="fa fa-print col-auto" aria-hidden="true"></i>
        </a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome do produto</th>
                <th>Preço</th>
                <th>Loja</th>
                <th>Categorias</th>
                <th>Ações</th>
            </tr>
        </thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->name}}</td>
                        <td>R$ {{number_format($p->price, 2, ',','.')}}</td>
                        <td> {{$p->store->name}}</td>
                        <td>
                            @foreach($p->categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </td>

                       <td>
                            <div class="btn-group">
                                <a href="{{route('manager.products.edit', ['product'=> $p->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                            </div>
                            <div class="btn-group">


                                    <a href="{{route('manager.products.remove', ['product'=> $p->id])}}" type="submit" class="btn btn-sm btn-danger" data-confirm='Tem certeza de que deseja excluir o item selecionado?'><i class="fa fa-trash" aria-hidden="true"></i></a>

                            </div>

                        </td>
                    </tr>

                @endforeach
            </tbody>

    </table>
    {{$products->links()}}
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/events.js')}}"></script>
@endsection
