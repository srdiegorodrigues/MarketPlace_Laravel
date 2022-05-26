
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
        p{
            margin: 5px 0 1.5rem 1.5rem;
        }
        td.header-1{
            width: 25%;
            border: none;
            padding: 5px;
            text-align: left;
        }
        td.header-2{
            border: none;
            padding: 5px;
            text-align: left;
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
    <h2>Lojas cadastradas</h2>
</div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Loja</th>
            <th>Total de produtos</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stores as $store)
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->name}}</td>
                <td>{{$store->products->count()}}</td>

            </tr>
        @endforeach
        </tbody>

    </table>


</body>
</html>
