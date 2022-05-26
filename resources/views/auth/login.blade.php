@extends('layouts.front')

@section('content')
<div class="container">


    <div class="kpx_login">
        <h3 class="kpx_authTitle">Faça login ou <a href="{{ route('register') }}">Inscreva-se</a></h3>


        <div class="row kpx_row-sm-offset-3 kpx_socialButtons">
            <div class="col-xs-3 col-sm-3">
                <a href="{{route('social.login',['provider'=>'github'])}}" class="btn btn-lg btn-block kpx_btn-github" data-toggle="tooltip" data-placement="top" title="GitHub">
                    <i class="fa fa-github fa-2x"></i>
                    <span class="hidden-xs"></span>
                </a>
            </div>

            <div class="col-xs-3 col-sm-3">
                <a href="{{route('social.login',['provider'=>'google'])}}" class="btn btn-lg btn-block kpx_btn-google-plus" data-toggle="tooltip" data-placement="top" title="Google">
                    <i class="fa fa-google-plus fa-2x"></i>
                    <span class="hidden-xs"></span>
                </a>
            </div>
        </div>

        <div class="row kpx_row-sm-offset-3 kpx_loginOr">
            <div class="col-xs-12 col-sm-6">
                <hr class="kpx_hrOr">
                <span class="kpx_spanOr">ou</span>
            </div>
        </div>

        <div class="row kpx_row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">
                <form class="kpx_loginForm" method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="E-mail">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <hr>

                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-key"></span></span>
                        <input  type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <hr />
                    <button class="btn btn-lg btn-outline-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Acessar</button>
                </form>
            </div>
        </div>
        <div class="row kpx_row-sm-offset-3">
            <div class="col-xs-12 col-sm-3">
                <p></p>
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="remember-me">
                    <span class="custom-control-indicator"></span>
                </label>
                </p>

            </div>
            <div class="col-xs-12 col-sm-3">
                <p class="kpx_forgotPwd">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif
                </p>
            </div>

        </div>
    </div>
</div>
</div>


@endsection



