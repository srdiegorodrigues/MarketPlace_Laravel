@extends('layouts.front')



@section('content')


    <div class="col-12">
        <h2 class="header"><i class="fa fa-list" aria-hidden="true"></i> Nossas lojas</h2>
        <h5>Listamos aqui todas as lojas cadastradas em nosso site!</h5>
        <hr>
    </div>
    {{--<form action="{{route('stores.search')}}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Buscar loja:" class="form-control" value="{{$filters['filter'] ?? ''}}">
        <button type="submit" class="btn btn-outline-primary">Buscar</button>
    </form>--}}

    <div class="row front">

        @forelse($stores as $key => $store)
            <div class="col-md-3">
                <div class="card card-store">
                    <div class="card-img">
                        @if($store->logo)
                            <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da {{$store->name}}" class="img-fluid">
                        @else
                            <img src="{{asset('assets/img/no-store-photo.png')}}" alt="Logo temporária" class="img-fluid">


                        @endif
                    </div>
                    <div class="card-body mb-0">
                        <h5 class="card-title">{{$store->name}}</h5>
                        <p class="card-text">{{$store->description}}</p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{route('store.single',['slug'=> $store->slug])}}" class="btn btn-sm btn-primary col-md-auto">Visite</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            @if(($key +1 ) % 4 == 0)
    </div>
    <div class="row front">@endif
        @empty
            <div class="alert alert-danger">Ainda não temos lojas cadastradas</div>
        @endforelse
    </div>
        <div class="col-12">
            {{$stores->links()}}
        </div>
    </div>


@endsection




