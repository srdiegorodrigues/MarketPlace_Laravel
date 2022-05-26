@extends('layouts.front')


@section('content')

    <div class="row layout-front">
        <div class="col-12">
            <h2 class="header"><i class="fa fa-shopping-bag" aria-hidden="true" placeholder="Quantidade"></i> Sacola de Compras</h2>
            <hr>
            @include('flash::message')
        </div>

        <div class="col-12">
            @if($cart)
                <a href="{{route('home')}}" class="btn btn-primary float-right btn-keep-buying">Continuar comprando</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>




                    @php $total=0; @endphp

                    @foreach($cart as $c)

                        <tr>
                            <td>{{$c['name']}}</td>
                            <td>R$ {{number_format($c['price'], 2, ',','.')}}</td>
                            <td class="form-inline row">
                                <form action="{{route('cart.remove.item')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="product[name]" value="{{$c['name']}}">
                                    <input type="hidden" name="product[price]" value="{{$c['price']}}">
                                    <input type="hidden" name="product[slug]" value="{{$c['slug']}}">
                                    <input type="hidden" name="product[amount]" value={{$c['amount']}}>

                                    <button class="btn btn-sm col-md-auto "><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                </form>

                                <span class="form-control col-auto" type="number" id="amount" name="amount">{{$c['amount']}}</span>
                                <form action="{{route('cart.add')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product[name]" value="{{$c['name']}}">
                                    <input type="hidden" name="product[price]" value="{{$c['price']}}">
                                    <input type="hidden" name="product[slug]" value="{{$c['slug']}}">
                                    <input type="hidden" name="product[amount]" value=1>
                                    <button class="btn btn-sm col-md-auto "><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                </form>

                            </td>
                            @php
                                $subtotal = $c['price']*$c['amount'];
                                $total += $subtotal;
                            @endphp
                            <td>R$ {{number_format($subtotal, 2, ',','.')}}</td>
                            <td>
                                <a href="{{route('cart.remove',['slug' =>$c['slug']])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Total: </td>
                        <td colspan="2">R$ {{number_format($total, 2,',','.')}}</td>
                    </tr>
                    </tbody>

                </table>
                <hr>
                <a href="{{route('cart.cancel')}}" class="btn btn-danger float-left">Cancelar Compra</a>
                @if(!auth()->check())
                    <a href="{{route('login')}}" class="btn btn-success float-right ">Concluir Compra</a>
                @else
                    <a href="{{route('cart.address')}}" class="btn btn-success float-right ">Concluir Compra</a>
                @endif
            @else
                <div class="alert alert-warning">Carrinho vazio...</div>
            @endif


        </div>
    </div>
@endsection












