@extends('layouts.front')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastre-se') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone Residencial') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control " name="phone" value="{{ old('phone') }}" >

                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="mobile_phone" class="col-md-4 col-form-label text-md-right">{{ __('Celular/Whatsapp') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_phone" type="text" class="form-control " name="mobile_phone" value="{{ old('mobile_phone') }}" >

                            </div>
                        </div>
                        <hr>
                        <div>{{ __('Endereço') }}</div>

                        <div class="form-group row">

                            <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('CEP') }}</label>

                            <div class="col-md-6">

                                <input id="postal_code" type="text" class="form-control" name="postal_code" @error('postal_code') is-invalid @enderror">
                                @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Rua/Avenida') }}</label>

                            <div class="col-md-6">

                                <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}" >

                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="house_number" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>

                            <div class="col-md-6">

                                <input id="house_number" type="text" class="form-control" name="house_number" value="{{ old('house_number') }}" >

                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="neighborhood" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>
                            <div class="col-md-6">
                                <input id="neighborhood" type="text" class="form-control" name="neighborhood" value="{{ old('neighborhood') }}" >
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="complement" class="col-md-4 col-form-label text-md-right">{{ __('Complemento') }}</label>
                            <div class="col-md-6">
                                <input id="complement" type="text" class="form-control" name="complement" value="{{ old('complement') }}">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Cidade') }}</label>

                            <div class="col-md-6">

                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" >

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="country" type="hidden" class="form-control" name="country" value="BRASIL" >
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar a senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://www.geradordecep.com.br/assets/js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script src="{{asset('js/events.js')}}"></script>
    <script src="{{asset('js/functions.js')}}"></script>
@endsection
