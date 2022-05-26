<?php

namespace App\Http\Controllers;

use App\Services\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    public function calcShipping(ShippingService $shippingService, Request $request)
    {
        $shipping = $shippingService
                    ->setItem(\App\Product::whereSlug($request->productId)->firstOrFail())
                    ->calculateShipping($request->zipcode);
        $data = response()->json([
            'data' =>[
                'shipping' => $shipping
            ],
        ]);

        return $data;


    }


    /*//Calculando o frete
   public function shipping(Request $request)
   {
       $variaveis_extras = http_build_query($request->all());
       $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCdAvisoRecebimento=n&sCdMaoPropria=n&nVlValorDeclarado=0&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3&nCdFormato=1&" . $variaveis_extras;
       $unparsedResult = file_get_contents($url);
       $parsedResult = simplexml_load_string($unparsedResult);
       $result = array(
           'preco' => strval($parsedResult->cServico->Valor),
           'prazo' => strval($parsedResult->cServico->PrazoEntrega)
       );
       return(json_encode($result));
   }*/
}
