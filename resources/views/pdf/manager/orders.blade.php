<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6 - Relatório de pedidos</title>
    <style>
        table{
            width: 100%;

        }
        th{
            text-align: center;
            padding: 5px;
            border: 1px solid black;
            line-height: 1.5;
            font-size: 14px;
        }
        td{
            text-align: justify;
            font-size: 12px;
            border: 1px solid black;
            line-height: 1.5;
            padding: 5px;
        }

        thead{
            color: #FFFFFF;
            background-color: #1b1e21;
        }
        .register-rel{
            font-size: 8px;
            text-align: right;
            margin: 1.5rem 0 0 0;
            text-transform: uppercase;
            color: #555555;
        }
        .header-title{
            background-color: #2F538D;
            padding: 0.5rem;
        }
        h1{
            text-align: center;
            color: rgb(255, 255, 255);
            padding: 6px;
            text-transform: uppercase;
            font-size: 22px;
        }
        h2{
            color: #444444;
            font-size: 16px;
            padding: 5px;
            text-transform: uppercase;
            /*margin: 1.5rem 0 1.5rem 0.5rem;*/
        }
    </style>

</head>
<body>
<div class="header-title">
    <h1>Marketplace</h1>
</div>

<div class="register-rel">Relatório emitido no dia
    @php
        $today = date("d.m.y");
        echo $today;
    @endphp às @php
        $today = date("H:i:s");
        echo $today;
    @endphp
</div>

<div>
    <h2>Vendas realizadas</h2>
</div>
<table>
    <thead>
    <tr>
        <th>Pedido</th>
        <th>Cliente</th>
        <th>Produtos</th>
        <th>Qtd</th>
        <th>Preço Unitário</th>
        <th>Total</th>
        <th>Data</th>
    </tr>

    </thead>
    <tbody>
        @foreach($orders as $key => $order)
            @php
                $items = unserialize($order->items);
                $userDatas = \App\User::find($order->user_id);
            @endphp
            @foreach(filterItemsByStoreId($items, auth()->user()->store->id)  as $item)
            <tr style="page-break-after:always;">

                <td>{{$order->reference}}</td>
                <td>{{$userDatas->name}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['amount']}}</td>
                <td>R$ {{number_format($item['price'],2,',','.')}} </td>
                <td>R$ {{number_format($item['price'] * $item['amount'] ,2,',','.')}}</td>
                <td>{{$order->created_at->format('d/m/Y')}}</td>
            </tr>
        @endforeach
        </tbody>
    @endforeach
</table>
</body>
</html>



