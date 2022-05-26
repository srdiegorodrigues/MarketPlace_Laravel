<footer class="footer">
    <div class="container bottom_border">
        <div class="row">
            <div class=" col-sm-4">
                <h5 class="headin5_amrc col_white_amrc pt2">Atendimento</h5>
                <!--headin5_amrc-->
                <p class="mb10">Horário de funcionamento</p>
                <p><i class="fa fa-clock-o" aria-hidden="true"></i> Segunda a sexta: 08:00 às 19:00 </p>
                <p><i class="fa fa-phone"></i>  (31) 12345-1469  </p>
                <p><i class="fa fa fa-envelope"></i> contato@marketplace.wsesportiva.com.br  </p>
            </div>
            <div class=" col-sm-4">
                <h5 class="headin5_amrc col_white_amrc pt2">Institucional</h5>
                <!--headin5_amrc-->
                <ul class="footer_ul2_amrc">
                    <li><a href="{{route('home')}}">Ofertas</a></li>
                    <li><a href="{{route('home')}}">Produtos</a></li>
                </ul>
                <!--footer_ul_amrc ends here-->
            </div>
            <div class=" col-sm-4">
                <h5 class="headin5_amrc col_white_amrc pt2">Conta</h5>
                <!--headin5_amrc ends here-->
                <ul class="footer_ul2_amrc">
                    <li><a href="{{route('user.my-profile')}}">Minha conta</a>
                    <li><a href="{{route('user.order.my')}}" >Acompanhe seus Pedidos</a></li>
                </ul>
                <!--footer_ul2_amrc ends here-->
            </div>
        </div>
        </div>
    </div>
    <div class="container">
        <ul class="foote_bottom_ul_amrc">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('home')}}">Ofertas</a></li>
            <li><a href="{{route('home.stores')}}">Lojas</a></li>
        </ul>
        <!--foote_bottom_ul_amrc ends here-->
        <p class="text-center"><i class="fa fa-copyright" aria-hidden="true"></i> Copyright 2022 | Desenvolvido por Diego de Souza Rodrigues <a href="#">TCC</a></p>

        <!--social_footer_ul ends here-->
    </div>
</footer>

<script src="{{asset('js/app.js')}}"></script>
@stack('component-scripts')






