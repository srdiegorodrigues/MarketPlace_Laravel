<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil do usuário</title>
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
<style>

    body{
        width: 100%;
        height: 100%;
        padding: 0;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
    }

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
        margin-left: 1.5rem;
        color: #555555;
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

    </style>
</head>
<body class="rel">
    <div class="header-title">
        <h1>Marketplace</h1>
    </div>
    <div class="register-rel">Relatório emitido no dia @php
            $today = date("d.m.y"); ;
            echo $today;
        @endphp às @php
            $today = date("H:i:s");
            echo $today;
        @endphp
    </div>
    <hr>
    <div class="header-title">
        <h3>Usuário</h3>
    </div>
        <p>
            Nome: {{$user['name']}}<br>
            E-mail: {{$user['email']}}<br>
            Telefone residencial: {{$user['phone']}}, Celular: {{$user['mobile_phone']}}</p>
        <hr>
    <div class="header-title">
        <h3>Endereço</h3>
    </div>
        <p>Rua: {{$user['street']}}, nº: {{$user['house_number']}},{{$user['neighborhood']}}<br>
        Complemento: {{$user['complement']}}<br>
        CEP: {{$user['postal_code']}}, {{$user['city']}}/ {{$user['state']}}<br>
        {{$user['country']}}</p>
    <p>
        <h4>Data de criação da conta: {{$user['created_at']->format('d/m/Y H:i')}}</h4>
    </p>

</body>
</html>
