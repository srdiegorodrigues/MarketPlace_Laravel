@extends('layouts.manager')

@section('content')
    <div class="row layout-manager">
        <div class="col-12">
            <h2>Pedidos recebidos</h2>
            <hr>


            @if($orders->items() != [])
            <a href="{{route('manager.pdf.orders.store')}}" class="btn btn-sm btn-outline-danger float-right btn-keep-buying" target="_blank">
                <i class="fa fa-print" aria-hidden="true"></i>
            </a>
                @endif

        </div>


        <div class="col-12">

            <div class="accordion" id="accordion">
               @forelse($orders as $key => $order)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                    Pedido nº: {{$order->reference}}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <a href="{{route('manager.pdf.order.user',['order' => $order->id])}}" class="btn btn-sm btn-outline-danger float-right btn-keep-buying" target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                </a>
                                <ul>
                                    @php
                                        /*$items = unserialize($order->items);*/
                                        $userDatas = \App\User::find($order->user_id);
                                    @endphp
                                    @foreach(filterItemsByStoreId($order->items, auth()->user()->store->id)  as $item)

                                        <li>Produto: {{$item['name']}}
                                            <p>Quantidade solicitada: {{$item['amount']}}
                                            <br>Preço por produto: R$ {{number_format($item['price'] ,2,',','.')}}
                                            <br>Total: R$ {{number_format($item['price'] * $item['amount'] ,2,',','.')}}
                                            </p>

                                        </li>

                                    @endforeach
                                    <hr>
                                    <h3>Dados cliente</h3>
                                    <strong>Cliente:</strong> {{$userDatas->name}}<br>
                                    <strong>Telefone:</strong> {{$userDatas->mobile_phone}}<br>
                                    <strong>Endereço</strong>{{$userDatas->street}}, nº {{$userDatas->house_number}}<br>
                                    <strong>Complemento:</strong>  {{$userDatas->complement}}<br>
                                    <strong>Bairro:</strong>  {{$userDatas->neighborhood}}<br>
                                    <strong>CEP:</strong> {{$userDatas->postal_code}}<br>
                                    <strong>{{$userDatas->city}}/{{$userDatas->country}}</strong><br>
                                    <strong>Data de solicitação:</strong> {{$order->created_at}}
                                </ul>

                            </div>
                        </div>
                    </div>
                @empty
                   <div class="alert alert-warning">Nenhum pedido recebido!</div>
                @endforelse

            </div>
            <div class="col-12">
                {{$orders->links()}}
            </div>

        </div>

    </div>

@endsection
