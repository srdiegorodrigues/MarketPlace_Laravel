<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>

    @yield('stylesheets')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="nav-link" href="{{route('home')}}"><img src="{{asset('assets/img/logo.png')}}" alt="barganhas.com" class="logotype"></a>

        <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('home')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Ofertas</a>
                </li>
                <li class="nav-item @if(request()->is('home/stores')) active @endif">
                    <a class="nav-link" href="{{route('home.stores')}}">Lojas</a>
                </li>
                <div class="dropdown nav-item">
                    <button class="btn dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Departamentos
                    </button>
                    <div class="dropdown-menu">
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{route('category.single',['slug' => $category->slug])}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </div>
                </div>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-search">
                    <form action="{{route('home.search')}}" method="POST" class="form-inline nav-search">
                        @csrf
                        {{--<button type="submit" class="btn btn-primary"><i class="fa fa-search fa-1x"></i></button>
                        <input name="filter" placeholder="Buscar produto" type="search" class="col-8 form-control text-sm-left">--}}
                        <div class="input-group search-home">

                                <input name="filter" class="form-control search-home" type="search" placeholder="Pesquisar" aria-label="Search" value="{{$filter ?? ''}}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text"><i class="fa fa-search fa-1x"></i></button>
                                </div>

                        </div>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav access">
                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="nav-link" alt="Carrinho">
                        @if(session()->has('cart'))
                            <span class="badge badge-danger" alt="Carrinho">{{count(session()->get('cart'))}}</span>
                        @endif
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item access">
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

                                        <a href="{{route('login')}}" class="nav-link" ><i class="fa fa-sign-in"></i> Acessar</a>
                                @endif
                        </div>
                    </div>
                </li>
            </ul>

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
