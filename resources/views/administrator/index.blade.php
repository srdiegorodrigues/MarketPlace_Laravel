@extends('layouts.administrator')


@section('content')

    <div class="row front col-md-12 layout-manager">

        <div class="col-md-3">
            <div class="card card-store">
                <div class="card-img">
                </div>
                <div class="card-body ">
                    <h5>Usuários: {{$users}}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-store">
                <div class="card-img">
                </div>
                <div class="card-body ">
                    <h5>Lojas: {{$stores}}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-store">
                <div class="card-img">
                </div>
                <div class="card-body ">
                    <h5>Produtos: {{$products}}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-store">
                <div class="card-img">
                </div>
                <div class="card-body ">
                    <h5>Categorias: {{$categories}}</h5>
                </div>
            </div>
        </div>

    </div>

@endsection



