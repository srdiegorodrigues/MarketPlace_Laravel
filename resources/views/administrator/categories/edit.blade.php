@extends('layouts.administrator')

@section('content')
    <div class="layout-manager col-lg-6">
    <h1>Atualizar Categoria</h1>
        <hr>
    <form action="{{route('administrator.categories.update', ['category' => $category->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" id="description" name="description" class="form-control" value="{{$category->description}}">
        </div>


        <div class="float-right">
            <div class="btn-group">
                <button type="submit" class="btn btn-md btn-success float-right">Atualizar</button>
            </div>
            <div class="btn-group">
                <a href="{{route('administrator.categories.index')}}" type="submit" class="btn btn-md btn-danger">Cancelar</a>
            </div>
        </div>

    </form>
    </div>
@endsection
