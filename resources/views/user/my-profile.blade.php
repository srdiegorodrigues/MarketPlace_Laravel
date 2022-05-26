@extends('layouts.front')

@section('content')
    @include('flash::message')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header btn-keep-buying">Dados cadastrais  <a href="#" class="btn-pages">
                                <a href="{{route('user.pdf.profile')}}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                            </a></h3>
                    </div>
                    <div class="card-body">
                        <h5>Nome: {{$user['name']}}</h5>
                        <hr>
                        <h3>Contato</h3>
                        <p>E-mail: {{$user['email']}}</p>
                        <p>Telefone residencial: {{$user['phone']}}</p>
                        <p>Celular: {{$user['mobile_phone']}}</p>
                        <hr>
                        <h3>Endereço</h3>
                        <p>Rua: {{$user['street']}}, nº: {{$user['house_number']}}</p>
                        <p>Bairro: {{$user['neighborhood']}}</p>
                        <p>Complemento: {{$user['complement']}}</p>
                        <p>Cidade: {{$user['city']}}</p>
                        <p>Estado: {{$user['state']}}</p>
                        <p>CEP: {{$user['postal_code']}}</p>
                        <p>País: {{$user['country']}}</p>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{route('user.edit',[$user->id] )}}" type="submit" class="btn-pages">{{__('Editar') }}
                            </a>
                            |
                            <a href="{{route('user.password')}}" type="submit"  class="btn-pages" >
                                {{ __('Alterar senha') }}
                            </a>
                            |
                            <a href="{{route('user.remove',[$user->id] )}}" data-confirm='Tem certeza de que deseja excluir o item selecionado?' type="submit" class="btn-pages">{{__('Excluir conta') }}</a>
                            |
                            @if(auth()->user()->role == 'ADMINISTRATOR')
                                <a href="{{route('administrator.users.list')}}" class="btn-pages">
                                        {{ __('Voltar') }}
                                </a>
                            @else
                                <a href="{{route('home')}}" class="btn-pages">
                                    {{ __('Voltar') }}
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('js/events.js')}}"></script>
@endsection


