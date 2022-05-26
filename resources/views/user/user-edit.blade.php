@extends('layouts.front')

@section('content')


    <div class="a-row">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="header">Dados cadastrais</h2>

                        <a href="{{route('user.my-profile')}}"  class="btn btn-success">
                            {{ __('Voltar') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('user.update',[$user->id])}}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @if(auth()->user()->id === $user->id)
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right" >{{ __('Telefone Residencial') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$user->phone}}"required autofocus>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile_phone" class="col-md-4 col-form-label text-md-right"  >{{ __('Celular/Whatsapp') }}</label>
                                <div class="col-md-6">
                                    <input id="mobile_phone" type="text" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone" value="{{$user->mobile_phone}}" required autofocus>
                                    @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div>{{ __('Endereço') }}</div>

                            <div class="form-group row">
                                <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('CEP') }}</label>
                                <div class="col-md-6">
                                    <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{$user->postal_code}}" required autofocus>
                                    @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="street" class="col-md-4 col-form-label text-md-right ">{{ __('Rua/Avenida') }}</label>
                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{$user->street}}" required autofocus>
                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="house_number" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>
                                <div class="col-md-6">
                                    <input id="house_number" type="text" class="form-control @error('street') is-invalid @enderror" name="house_number" value="{{$user->house_number}}" required autofocus>
                                    @error('house_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="neighborhood" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>
                                <div class="col-md-6">
                                    <input id="neighborhood" type="text" class="form-control @error('neighborhood') is-invalid @enderror" name="neighborhood" value="{{$user->neighborhood}}" required autofocus>
                                    @error('neighborhood')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Complemento') }}</label>
                                <div class="col-md-6">
                                <input id="complement" type="text" class="form-control " name="complement" value="{{$user->complement}}">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Cidade') }}</label>
                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$user->city}}" required autofocus>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                                <div class="col-md-6">
                                    <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{$user->state}}" required autofocus>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('País') }}</label>
                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{$user->country}}" autofocus>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            @if(auth()->user()->role == 'ADMINISTRATOR')
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Papel do usuário') }}</label>
                                <div class="col-md-2">
                                    <label><input type="radio" name="role" value="ROLE_USER" @if($user->role == "ROLE_USER") checked @endif> Cliente</label>
                                </div>
                                <div class="col-md-2">
                                    <label><input type="radio" name="role" value="ROLE_OWNER" @if($user->role == "ROLER_OWNER") checked @endif> Dono de loja</label>
                                </div>
                                <div class="col-md-2">
                                    <label><input type="radio" name="role" value="ADMINISTRATOR" @if($user->role == "ADMINISTRATOR") checked @endif> Administrador</label>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Salvar alterações') }}
                                    </button>
                                    @if(auth()->user()->role == 'ADMINISTRATOR')
                                        <a href="{{route('administrator.users.list')}}"  class="btn btn-danger"  >
                                            {{ __('Cancelar') }}
                                        </a>
                                    @else
                                        <a href="{{route('user.my-profile')}}"  class="btn btn-danger">
                                            {{ __('Cancelar') }}
                                        </a>
                                    @endif
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
