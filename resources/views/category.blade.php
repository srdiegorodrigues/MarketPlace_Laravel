@extends('layouts.front')


@section('content')


        <div class="row layout-front">
            <div class="col-12">
                <h3 class="header"><i class="fa fa-check" aria-hidden="true"></i> {{$category->name}}</h3>
                <hr>
            </div>
            @forelse($category->products as $key => $product)
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
                    @if(($key +1 ) % 4 == 0) </div>
            <div class="row front">@endif
                @empty
                    <div class="col-12">
                        <h3 class="alert alert-warning">Nenhum produto encontrado para esta categoria!</h3>
                    </div>
                @endforelse
            </div>
         <div>
         </div>


@endsection


