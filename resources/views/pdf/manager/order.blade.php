<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace - Pedido</title>
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <style>


        .header-title{
            background: #2F538D;
        }

        h1{
            text-align: center;
            color: rgb(255, 255, 255);
            padding: 6px;
            text-transform: capitalize;
        }
        h3{
            color: #FFFFFF;
            font-size: 18px;
            margin: 1.5rem 0 1.5rem 0.5rem;
        }
        .register-rel{
            font-size: 12px;
            text-align: right;
            margin-right: 0.5rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            color: #555555;
        }
        p{

            margin: 3px 0 3px 1.5rem;
        }
        hr{
            border-width: 1px;
            border-style: groove;
            border-color: #2196f3;
        }
        .rel {
            border-width: 2px;
            border-style: groove;
            border-color: #2196f3;
            line-height: 1.7;
            color: #101010;
            text-align: jusfity;
            padding: 10px;
            margin-bottom: 15px;
            position: relative;
            box-shadow: 0 10px 6px -6px #aaa;
        }
        .client{
            border-style:dashed;
            border-radius: 5px;
            padding: 15px;
            margin: 1rem;
            width: 75%;
        }
        h4{
            margin-bottom: 2px;
        }
        .contact{

            margin: 3px 0 3px 1.5rem;
        }
        table{
            width: 100%;

        }
        th, td {
            text-align: center;
            padding: 5px;
            border: 1px solid black;
            line-height: 1.7;
            font-size: 14px;
        }
        td{
            text-align: justify;
            font-size: 12px;
            border: 1px solid black;
            line-height: 1.5;
        }

        thead{
            color: #FFFFFF;
            background-color: #1b1e21;
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

    <table>
        <thead>
        <tr>
            <th>Número do pedido</th>
            <th>Produto</th>
            <th>Qtd Solicitada</th>
            <th>Preço Unitário</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php
            $userDatas = \App\User::find($order->user_id);
        @endphp
        @foreach(filterItemsByStoreId($order->items, auth()->user()->store->id)  as $item)
        <tr>
            <td>{{$order->reference}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['amount']}}</td>
            <td>R$ {{number_format($item['price'],2,',','.')}}</td>
            <td>R$ {{number_format($item['price'] * $item['amount'] ,2,',','.')}}</td>

        </tr>
        @endforeach
        </tbody>
    </table>
    <h4>Comprador</h4>
    <div class="client">
        <strong>Destinatário</strong><br>
        Nome: {{$userDatas->name}}<br>
        Endereço: {{$userDatas->street}}, nº {{$userDatas->house_number}}<br>
        Bairro: {{$userDatas->neighborhood}} /
        Complemento: {{$userDatas->complement}}<br>
        CEP: {{$userDatas->postal_code}} /
        {{$userDatas->city}}/ {{$userDatas->state}} <br>
            {{$userDatas->country}}<br>
        Data da solicitação: {{$order->created_at->format('d/m/Y')}}
    </div>
    <h4>Contato: </h4>
    <div class="contact">

        <p>Telefone Residencial: {{$userDatas->phone}}<br>
        Celular/Whatsapp: {{$userDatas->mobile_phone}}<br>
            E-mail: {{$userDatas->email}}</p>
    </div>

</body>
</html>
