<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6 - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('stylesheets')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="nav-link" href="{{route('home')}}"><img src="{{asset('assets/img/logo.png')}}" alt="barganhas.com" class="logotype"></a>
        <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </a>
        <div class="navbar-nav container" id="navbarSupportedContent">
            @auth
            <ul class="navbar-nav container-fluid">
                    <li class="nav-item @if(request()->is('administrator/')) active @endif">
                        <a class="nav-link" href="{{route('administrator.index')}}">Dashboard</a>
                    </li>
                    <li class="nav-item @if(request()->is('administrator/users*')) active @endif">
                        <a class="nav-link" href="{{route('administrator.users.list')}}">Usuários</a>
                    </li>

                    <li class="nav-item @if(request()->is('administrator/stores*')) active @endif">
                        <a class="nav-link" href="{{route('administrator.stores.list')}}">Lojas <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if(request()->is('administrator/products*')) active @endif">
                        <a class="nav-link" href="{{route('administrator.products.list')}}">Produtos</a>
                    </li>
                    <li class="nav-item @if(request()->is('administrator/categories*')) active @endif">
                        <a class="nav-link" href="{{route('administrator.categories.index')}}">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown nav-item btn-group">
                            <button class="dropdown-toggle nav-link @if(request()->is('administrator/charts*')) active @endif" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Gráficos
                            </button>
                            <div class="dropdown-menu dropdown-menu-right nav-item">
                                <a class="dropdown-item" href="{{route('administrator.charts.users')}}">Novos usuários</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('administrator.charts.orders')}}">Vendas</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="my-2 my-lg-0 ">
                    <ul class="navbar-nav mr-auto container-fluid access">


                    <li class="nav-item">
                        @if(auth()->user())
                            <div class="dropdown nav-item btn-group">
                                @php $name = auth()->user()->name;
                                $firtsname = explode(" ", $name);
                                @endphp
                                <button class="dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Olá, {{$firtsname[0]}}!
                                </button>
                                <div class="dropdown-menu dropdown-menu-right nav-item">
                                    @auth
                                        <a href="{{route('user.my-profile')}}" class="dropdown-item">Minha conta</a>
                                        <a href="{{route('user.order.my')}}" class="dropdown-item">Meus Pedidos</a>

                                        @if(auth()->user()->role == 'ROLE_OWNER' || auth()->user()->role == 'ADMINISTRATOR' )
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('manager.stores.index')}}" class="dropdown-item">Minha loja</a>
                                        @endif

                                    @endauth
                                    @auth
                                        @if(auth()->user()->role == 'ADMINISTRATOR')
                                            <a href="{{route('administrator.index')}}" class="dropdown-item">Administração</a>
                                        @endif
                                    @endauth
                                    <div class="dropdown-divider"></div>
                                    @auth
                                        <button class="dropdown-item"onclick="event.preventDefault();
                                        document.querySelector('form.logout').submit();"> <strong>Não é você? Sair </strong></button>
                                        <form action="{{route('logout')}}" class="logout" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endauth
                                    @else
                                        <a href="{{route('login')}}" class="nav-link" >Acesse <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                                    @endif
                                </div>
                            </div>
                    </li>
                </ul>
        </div>
            @endauth
        </div>
    </nav>


    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    @include('layouts.footer')
    @yield('scripts')

</body>
</html>
