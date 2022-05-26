@extends('layouts.manager')
@section('content')

    <h1>Criar Loja</h1>

    <form action="{{route('administrator.stores.store')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}" >
        <div class="form-group">
            <label>Nome: </label>
            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{old('name')}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" value="{{old('description')}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
            @error('description')
            <div class="phone">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{old('mobile_phone')}}">
            @error('mobile_phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label> Logomarca do site</label>
            <input type="file" name="logo"class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="float-right">
            <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-success">Atualizar dados</button>
            </div>
            <div class="btn-group">
                <a href="{{route('administrator.index')}}" type="submit" class="btn btn-sm btn-primary">Voltar</a>
            </div>
        </div>

    </form>
@section('scripts')


    <script>
        var imPhone = new Inputmask('(99) 9999-9999');
        imPhone.mask(document.getElementById('phone'));
        var imMobilePhone = new Inputmask('(99) 9 9999-9999');
        imMobilePhone.mask(document.getElementById('mobile_phone'));
    </script>
@endsection


@endsection



