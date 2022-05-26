@extends('layouts.administrator')


@section('content')
        <a href="{{route('administrator.categories.create')}}" class="btn btn-primary float-right btn-keep-buying">Criar Categoria</a>


    <table class="table table-striped ">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td width="15%">
                    <div class="btn-group">
                        <a href="{{route('administrator.categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                    </div>
                    <div class="btn-group">
                            <a href="{{route('administrator.categories.remove', ['category' => $category->id])}}" type="submit" class="btn btn-sm btn-danger" data-confirm='Tem certeza de que deseja excluir o item selecionado?'><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('scripts')
\
    <script src="{{asset('js/events.js')}}"></script>
@endsection
