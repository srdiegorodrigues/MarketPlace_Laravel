@extends('layouts.front')
@section('content')


    @include('flash::message')
    <div class="row front">
        @if ($products)
            @foreach($products as $key => $product)
                <div class="col-md-3">
                    <div class="card card-store">
                        <div class="card-img">
                            @if($product->photos->count())
                                <img src="{{asset('storage/' . $product->thumb)}}" class="card-img-top img-fluid">
                            @else
                                <img src="{{asset('assets/img/no-photo.jpg')}}" class="card-img-top img-fluid">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">{{$product->description}}</p>
                            <h5>R$ {{number_format($product->price, '2',',','.')}}</h5>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{route('product.single',['slug'=>$product->slug])}}" class="btn btn-sm btn-success col-md-auto">
                                        Ver Produto
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
                @if(($key +1 ) % 4 == 0)
        </div>
        <div class="row front">
                @endif
            @endforeach
            @else
                <h1>Ainda não foram cadastrados produtos</h1>
            @endif
    </div>

    <div class="col-12" >
        {{$products->links()}}
    </div>

    <div class="row front">
        <div class="col-12">
            <h2 class="header"><i class="fa fa-star fa-1x" aria-hidden="true"></i> Lojas em Destaque</h2>
            <hr>
        </div>

        @foreach($stores as $store)
            <div class="col-md-3">
                <div class="card card-store">
                    <div class="card-img">
                        @if($store->logo)
                            <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da {{$store->name}}" class="card-img-top img-fluid img-adjusted">
                        @else
                            <img src="{{asset('assets/img/no-store-photo.png')}}" alt="Logo temporária" class="card-img-top img-fluid img-adjusted">
                        @endif
                    </div>
                    <div class="card-body ">
                        <h5 class="card-title">{{$store->name}}</h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{route('store.single',['slug'=> $store->slug])}}" class="btn btn-sm btn-primary col-md-auto">Visite</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        @endforeach
    </div>




@endsection





