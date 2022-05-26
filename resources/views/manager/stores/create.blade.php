@extends('layouts.manager')
@section('content')
<div class="layout-manager">
    <h3>Criar Loja</h3>
    <hr>

    <form action="{{route('manager.stores.store')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}" >
        <div class="form-group">
            <label>Nome da loja</label>
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
            <label> Foto da Loja</label>
            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <h4>{{ __('Endereço') }}</h4>
        <hr>
        <div class="form-group ">
            <label>{{ __('CEP') }}</label>
            <input id="postal_code" name="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" value="{{old('postal_code')}}">
            @error('postal_code')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Rua/Avenida') }}</label>
            <input id="street" name="street" type="text" class="form-control @error('street') is-invalid @enderror" value="{{old('street')}}">
            @error('street')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Número') }}</label>
            <input id="house_number" name="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" value="{{old('house_number')}}">
            @error('house_number')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Bairro') }}</label>
            <input id="neighborhood" name="neighborhood" type="text" class="form-control @error('neighborhood') is-invalid @enderror" value="{{old('neighborhood')}}">
            @error('neighborhood')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group ">
            <label>{{ __('Complemento') }}</label>
            <input id="complement" name="complement" type="text" class="form-control @error('complement') is-invalid @enderror" value="{{old('complement')}}">
            @error('complement')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group ">
            <label>{{ __('Cidade') }}</label>
            <input id="city" name="city" type="text" class="form-control @error('city') is-invalid @enderror" value="{{old('city')}}">
            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Estado') }}</label>
            <input id="state"  name="state"type="text" class="form-control @error('state') is-invalid @enderror" value="{{old('state')}}">
            @error('state')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <input id="country" type="hidden" class="form-control" name="country" value="BRASIL" >
        <div class="float-right">
            <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-success">Salvar loja</button>
            </div>
            <div class="btn-group">
                <a href="{{route('manager.stores.index')}}" type="submit" class="btn btn-sm btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
    <script src="https://www.geradordecep.com.br/assets/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="{{asset('js/events.js')}}"></script>
    <script src="{{asset('js/functions.js')}}"></script>
@endsection



