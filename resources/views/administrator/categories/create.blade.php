@extends('layouts.administrator')

@section('content')
    <div class="layout-manager col-lg-6">
    <h1>Criar Categoria</h1>
        <hr>
    <form action="{{route('administrator.categories.category')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="float-right">
            <div class="btn-group">
                <button type="submit" class="btn btn-md btn-success float-right">Salvar Categoria</button>
            </div>
            <div class="btn-group">
                <a href="{{route('administrator.categories.index')}}" type="submit" class="btn btn-md btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
    </div>
@endsection
