@extends('layouts.front')


@section('content')
    @include('flash::message')
    <div class="row layout-front">


        <div class="col-6">
            @if($product->photos->count())
                <img src="{{asset('storage/' . $product->thumb)}}" alt="" class="product-img thumb">
                <div class="row" style="margin-top: 20px;">
                    @foreach($product->photos as $photo)
                        <div class="col-2">
                            <img src="{{asset('storage/' . $photo->image)}}" alt="" class="icon-img img-fluid img-small">
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
            @endif
        </div>
        <div class="col-6">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>
                <p>{{$product->description}}</p>
                <h3>R$ {{number_format($product->price, '2',',','.')}}</h3>
                <span>Loja: {{$product->store->name}}</span>
            </div>


           <div class="product-add col-md-12">
               <hr>
               <form action="{{route('cart.add')}}" method="post">
                   @csrf
                       <input type="hidden" name="product[name]" value="{{$product->name}}">
                       <input type="hidden" name="product[price]" value="{{$product->price}}">
                       <input type="hidden" name="product[slug]" value="{{$product->slug}}">


                   <div class="form-inline">

                       <input type="number" name="product[amount]"class="form-control col-md-2" value="1">
                       <div class="col-md-auto"></div>
                       <button class="btn btn-md btn-danger col-md-3 "><i class="fa fa-shopping-bag" aria-hidden="true"></i> Adicionar</button>
                   </div>
               </form>
               <hr>
           </div>

            <div class="col-12">
                <h5 class="alert alert-success text-center">Frete grátis para todo o Brasil</h5>
            </div>
           {{-- <div class="col-md-12">
                <x-shipping :url="'/api/shipping'"/>

            </div>--}}
        </div>



    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{$product->body}}
        </div>
    </div>

@endsection







