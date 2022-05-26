@extends('layouts.manager')
@section('content')
<div class="layout-manager">
    <h3>Atualizar Loja</h3>


    <hr>
    <form action="{{route('manager.stores.update',['store' => $store->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label>Nome da loja</label>
            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$store->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" value="{{$store->description}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="phone" id="phone"  class="form-control  @error('phone') is-invalid @enderror" value="{{$store->phone}}">
            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control  @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
            @error('mobile_phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
                <img src="{{asset('storage/'.$store->logo)}}" alt="" class="icon-img img-fluid">
            <label> Carregar nova logomarca</label>
            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <hr>
        <h4>{{ __('Endereço') }}</h4>

        <div class="form-group">
            <label>CEP</label>
                <input id="postal_code" type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{$store->postal_code}}">
                @error('postal_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>

        <div class="form-group">
            <label>Rua/Av</label>
            <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{$store->street}}" >
            @error('street')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Número') }}</label>
            <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{$store->house_number}}" >
            @error('house_number')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Bairro') }}</label>
            <input id="neighborhood" type="text" class="form-control @error('neighborhood') is-invalid @enderror" name="neighborhood" value="{{$store->neighborhood}}" >
            @error('house_number')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Complemento') }}</label>
                <input id="complement" type="text" class="form-control @error('complement') is-invalid @enderror" name="complement" value="{{$store->complement}}">
            @error('complement')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Cidade') }}</label>
            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$store->city}}" >
            @error('city')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Estado') }}</label>
            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{$store->state}}" >
            @error('state')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input id="country" type="hidden" class="form-control" name="country" value="BRASIL">
        <div class="float-right">
            <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-success">Atualizar</button>
            </div>

            @if(auth()->user()->role =='ROLE_OWNER')
                <div class="btn-group">
                    <a href="{{route('manager.stores.index')}}" type="submit" class="btn btn-sm btn-danger">Cancelar</a>
                </div>

            @else
                <div class="btn-group">
                    <a href="{{route('administrator.stores.list')}}" type="submit" class="btn btn-sm btn-danger">Cancelar</a>
                </div>
            @endif
        </div>
    </form>


</div>

@endsection
@section('scripts')
    <script src="https://www.geradordecep.com.br/assets/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="{{asset('js/events.js')}}"></script>
    <script src="{{asset('js/functions.js')}}"></script>
@endsection

