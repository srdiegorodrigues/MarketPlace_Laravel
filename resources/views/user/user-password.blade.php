@extends('layouts.front')

@section('content')
    @if($user->provider === null)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Atualize sua senha') }}</div>
                        {{--@php $old_password = auth()->user()->password;
                        @endphp
                        @dd($old_password)--}}

                        <div class="card-body">
                            <form method="POST" action="{{route('user.update-password')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                                    <div class="col-md-6">
                                        <strong>{{$user['name']}}</strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                    {{--<input type="hidden" name="email" value="{{$user['email']}}" >--}}
                                    <div class="col-md-6">
                                        <strong>{{$user['email']}}</strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="old-password" class="col-md-4 col-form-label text-md-right">{{ __('Senha atual') }}</label>

                                    <div class="col-md-6">
                                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required >
                                        @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nova Senha') }}</label>
                                    <div class="col-md-6">
                                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required >
                                        @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right" >{{ __('Confirmar a senha') }}</label>
                                    <div class="col-md-6">
                                        <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required>
                                        @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            {{ __('Atualizar') }}
                                        </button>
                                        <a href="{{route('user.my-profile')}}" type="submit" class="btn btn-sm btn-danger">{{__('Cancelar') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <h3 class="alert-danger text-center">Você realizou o cadastro no sistema utilizando o serviço integrado com o {{$user->provider}}.<br/>
        Para alterar sua senha, você deverá modifica-la diretamente no {{$user->provider}}.
            </h3>
            <div class="col-auto offset-md-11">
                <a href="{{route('user.my-profile')}}" type="submit" class="btn btn-sm btn-danger">{{__('Cancelar') }}</a>
            </div>
        </div>
    @endif

@endsection

