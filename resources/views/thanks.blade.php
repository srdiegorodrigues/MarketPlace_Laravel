@extends('layouts.front')


@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endsection

@section('content')
<div class="layout-front">
    <h1><i class="fa fa-check-circle" aria-hidden="true"></i> Agradecemos a preferência</h1>
    <hr>
    <h4>

        <p> Muito obrigado por sua compra!</p>

        <p> Código do pedido <i class="fa fa-arrow-right" aria-hidden="true"></i> <strong>{{request()->get('order')}}</strong></p>
        <p>Seu pedido foi processado</p>
        @if(request()->has('b'))
            <p>
                Para completar a ação, clique no botão abaixo:
            </p>
            <p>
               <span id="boleto"></span><a href="{{request()->get('b')}}" class="btn btn-lg btn-danger" target="_blank">Imprimir Boleto</a>
            </p>
        @endif
    </h4>
    <hr>

    <div class="float-right">
        <div class="btn-group">
            <a href="{{route('home')}}" class="btn btn-sm btn-primary btn-keep-buying">Continuar comprando</a>
        </div>
        <div class="btn-group">
            <a href="{{route('user.order.my')}}" class="btn btn-sm btn-success  btn-keep-buying">Meus Pedidos</a>
        </div>
    </div>
</div>
@endsection

