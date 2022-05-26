@extends('layouts.front')

@section('content')
    <div class="row layout-front">
        <div class="col-12">
            <h2 class="header">Meus pedidos</h2>
            @include('flash::message')
            <hr>
            <a href="{{route('user.pdf.orders')}}" class="btn btn-sm btn-outline-danger float-right btn-keep-buying" target="_blank">
                <i class="fa fa-print" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-12">
            <div class="accordion" id="accordion">
               @forelse($userOrders as $key => $order)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" style="text-transform: uppercase;" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                    Pedido nº: {{$order->reference}}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <ul>
                                    <div class="alert text-success alert-success text-center">{{$order->pagseguro_code}}</div>
                                    @foreach($order->items  as $item)
                                        <li><p>Produto: <strong>{{$item['name']}}</strong>
                                            <br> Valor de cada:R$ {{number_format($item['price'],2,',','.')}}
                                            <br> Valor da compra: R$ {{number_format($item['price'] * $item['amount'],2,',','.')}}
                                            <br>Quantidade solicitada: {{$item['amount']}}
                                            <br>Fornecedor: @php $store = \App\Store::find($item['store_id']); @endphp
                                            {{$store->name}}
                                            <br>Data da solicitação: {{$order->created_at->format('d/m/Y - H:i:s')}}

                                    @endforeach
                                                @if($order->type == 'BOLETO')
                                                    <br>Forma de Pagamento:
                                                    <a href="{{$order->link_boleto}}" class="text-danger" target="_blank"> <i class="fa fa-print" aria-hidden="true"></i> BOLETO</a>
                                                @else
                                                    <br>Forma de Pagamento: CARTÃO DE CRÉDITO<br>
                                                @endif
                                                @if($order->pagseguro_status == 1 or $order->pagseguro_status == 2)
                                                    <br>Status da compra: <span class="text-info col-sm-6" role="alert">Em análise. Sua compra está aguardando pagamento</span>
                                            <form method="POST" action="{{route('user.order.cancel',['pagseguro_code'=> $order->pagseguro_code]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    Cancelar compra
                                                </button>
                                            </form>
                                            @elseif($order->pagseguro_status == 3 or $order->pagseguro_status == 4 or $order->pagseguro_status ==5)

                                                <br>Status da compra: <span class="text-info col-sm-6" role="alert">Compra aprovada</span>
                                                <form method="POST" action="{{route('user.order.refund',['pagseguro_code'=> $order->pagseguro_code]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        Solicitar reembolso
                                                    </button>
                                                </form>
                                            @elseif($order->pagseguro_status == 6)
                                                <br>Status da compra: <span class="text-danger col-sm-6" role="alert">Compra Cancelada. O valor foi devolvido para o comprador</span>
                                            @elseif($order->pagseguro_status == 7)
                                                <br>Status da compra: <span class="text-danger col-sm-6" role="alert">Compra Cancelada</span>
                                            @else
                                                <br>Status da compra: <span class="text-info col-sm-6" role="alert">Em análise. Favor aguardar</span>
                                                @endif
                                                </p>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                   <div class="alert alert-warning">Você ainda não fez compras em nosso site!</div>
                @endforelse

            </div>
            {{--<div class="col-12">
                {{$userOrders->links()}}
            </div>
        </div>--}}
        </div>
    </div>

@endsection


