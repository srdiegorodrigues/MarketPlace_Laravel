<h1>Olá, {{$user->name}}, tudo bem? Espero que sim!</h1>
<h3>Obrigado por se cadastrar.</h3>

<p>
    Aproveite bastante e faça excelentes compras em nosso marketplace!<br>
    Seu email de cadastro é: <strong>{{$user->email}}</strong> <br>
    Sua senha: <strong>Por questões de segurança não enviamos sua senha.</strong>
</p>
<hr>
Email enviado em {{date('d/m/Y H:i:s')}}.

