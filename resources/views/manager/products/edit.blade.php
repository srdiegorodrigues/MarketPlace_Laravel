@extends('layouts.manager')
@section('content')
    <div class="layout-manager">
        <h3>Atualizar Produto</h3>
        <hr>

        <form action="{{route('manager.products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label>Nome Produto</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">

                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Conteúdo</label>
                <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$product->body}}</textarea>

                @error('body')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>


            <div class="form-group">
                <label>Preço</label>
                <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">

                @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Categorias</label>
                <select name="categories[]" id="" class="form-control" multiple>

                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($product->categories->contains($category)) selected @endif>
                            {{$category->name}}
                        </option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for=""> Fotos do produto</label>
                <input type="file" name="photos[]"class="form-control @error('photos.*') is-invalid @enderror" multiple>
                @error('photos.*')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>


            <div class="float-right">
                <div class="btn-group">
                    <button type="submit" class="btn btn-sm btn-success">Atualizar</button>
                </div>
                @if(auth()->user()->role == "ADMINISTRATOR")
                <div class="btn-group">
                    <a href="{{route('administrator.products.list')}}" type="submit" class="btn btn-sm btn-danger">Cancelar</a>
                </div>
                @else
                    <div class="btn-group">
                        <a href="{{route('manager.products.index')}}" type="submit" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                @endif
            </div>
        </form>


        <div class="row">
            <hr>
            @foreach($product->photos as $photo)
                <div class="col-4 text-center">
                    <img src="{{asset('storage/' . $photo->image)}}" alt="" class="icon-img img-fluid">
                    <form action="{{route('manager.photo.remove')}}" method="post">
                        @csrf
                        <input type="hidden" name="photoName" value="{{$photo->image}}">
                        <button type="submit" class="btn btn-lg btn-danger">Remover</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    </div>

@endsection
@section('scripts')

    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal:','});

    </script>

@endsection
