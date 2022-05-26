<?php

namespace App\Http\Controllers;

use App\User;


class UserOrderController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function userOrders()
    {
        $userOrders = auth()->user()->orders()->orderBy('id','desc')->get();
        return view('user.user-orders',compact('userOrders'));
    }

    //cancela uma compra com status em andamento ou em análise
    public function cancelOrder($pagseguro_code)
    {
        $email = env('PAGSEGURO_EMAIL');
        $token = env('PAGSEGURO_TOKEN_SANDBOX');
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/cancels?email='.$email.'&token='.$token.'&transactionCode='.$pagseguro_code;
        $Curl = curl_init($url);
        curl_setopt($Curl,CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1"));
        curl_setopt($Curl, CURLOPT_POST, true);
        curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
        $Retorno = curl_exec($Curl);
        curl_close($Curl);
        $Xml=simplexml_load_string($Retorno);

        flash('Sua solicitação de cancelamento do pedido '.$pagseguro_code.' foi enviada com sucesso!')->warning();
        return redirect()->route('user.order.my');

    }

    //Estorna o valor da compra para o cliente
    public function refundOrder($pagseguro_code)
    {
        $email = env('PAGSEGURO_EMAIL');
        $token = env('PAGSEGURO_TOKEN_SANDBOX');
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/refunds?email='.$email.'&token='.$token.'&transactionCode='.$pagseguro_code;
        $Curl=curl_init($url);
        curl_setopt($Curl,CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($Curl, CURLOPT_POST, true);
        curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($Curl);
        curl_close($Curl);
        $Xml=simplexml_load_string($retorno);

        flash('Sua solicitação de reembolso do pedido '.$pagseguro_code.' foi enviada com sucesso!')->warning();
        return redirect()->route('user.order.my');
    }

}
