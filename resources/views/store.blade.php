@extends('layouts.front')


@section('content')
    <div class="row front">
        <div class="col-4">
            @if($store->logo)
                <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da {{$store->name}}" class="img-fluid" style="height: 196px">
            @else
                <img src="{{asset('assets/img/no-store-photo.png')}}" alt="Logo temporária" class="img-fluid" style="height: 196px">
            @endif
        </div>
       <div class="col-8">
           <h2>{{$store->name}}</h2>
           <p>{{$store->description}}</p>
           <p>
               <strong>Contatos: </strong>
               <spam>{{$store->phone}}</spam> | <spam>{{$store->mobile_phone}}</spam>
           </p>
       </div>
        <div class="col-12">
            <hr>
            <h2 class="header">Produtos desta loja</h3>
        </div>
        @forelse($store->products as $key => $product)
            <div class="col-md-3">
                <div class="card card-store">
                    <div class="card-img">
                        @if($product->photos->count())
                            <img src="{{asset('storage/' . $product->thumb)}}" alt="" class="card-img-top img-fluid">
                        @else
                            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top img-fluid">
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
                @if(($key +1 ) % 4 == 0) </div><div class="row front">@endif
        @empty
            <div class="col-lg-12">
                <p class="alert alert-warning col-lg-12 text-center">Nenhum produto encontrado para esta loja!</p>
            </div>
        @endforelse
    </div>
@endsection


