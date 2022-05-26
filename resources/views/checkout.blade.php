@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')

    <div class="container layout-front">
        <div class="row bt-5">
            <div class="col-12">
                <div class="msg"></div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="creditCard-tab" data-toggle="tab" href="#creditCard" role="tab" aria-controls="creditCard" aria-selected="true">Cartão de Crédito</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="boleto-tab" data-toggle="tab" href="#boleto" role="tab" aria-controls="boleto" aria-selected="false">Boleto</a>
            </li>
        </ul>
        <div class="tab-content pt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="creditCard" role="tabpanel" aria-labelledby="creditCard-tab">
                <!-- Cartão de Crédito Conteúdo Tab-->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Dados para Pagamento</h2>
                            <hr>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Nome no cartão</label>
                                <input type="text" class="form-control" name="card_name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Número do cartão<span class="brand"></span></label>
                                <input type="text" class="form-control" name="card_number" maxlength="16">
                                <input type="hidden" name="card_brand">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Mês de Expiração</label>
                                <select name="card_month" id="card_month"class="form-control">
                                    <option></option>
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Ano de Expiração</label>
                                <select name="card_year" id="card_year" class="form-control">
                                    @php $year = idate('Y');
										$dateExpires = $year + 15;
                                    @endphp
                                    <option></option>
                                    @for($year; $year <= $dateExpires; $year++)
                                        <option value="{{$year}}">{{$year}}</option>
                                    @endfor
                                </select>
                            </div>


                            <div class="col-md-4 form-group">
                                <label>Código de Segurança</label>
                                <input type="text" class="form-control" name="card_cvv">
                            </div>

                        </div>
                            <div class="row">

                            <div class="col-md-12 installments form-group"></div>
                        </div>

                        <button class="btn btn-success btn-lg processCheckout"  data-payment-type="CREDITCARD">Efetuar Pagamento</button>
                    </form>
                </div>
                <!-- Fim Cartão de Crédito Conteúdo Tab-->
            </div>
            <!--Pagamento com boleto -->

            <div class="tab-pane fade" id="boleto" role="tabpanel" aria-labelledby="boleto-tab">

                <div class="row">
                    <div class="col-12">
                        <h2>Pagar com Boleto</h2>
                        <button class="btn btn-success btn-lg processCheckout" data-payment-type="BOLETO">Emitir Boleto</button>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        const urlThanks = '{{route('checkout.thanks')}}';
        const urlProccess = '{{route("checkout.proccess")}}';
        const amoutTransaction = '{{$cartItems}}';
        const csrf = '{{csrf_token()}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>
    <script src="{{asset('js/pagseguro_functions.js')}}"></script>
    <script src="{{asset('js/pagseguro_events.js')}}"></script>
@endsection

