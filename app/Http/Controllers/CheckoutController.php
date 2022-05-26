<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\Boleto;
use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Store;
use App\UserOrder;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;


class CheckoutController extends Controller
{
    public function index()
    {
        try {
            if(!auth()->check()) {
                return redirect()->route('login');
            }
            if(!session()->has('cart')) return redirect()->route('home');
            $this->makePagSeguroSession();
            $cartItems = array_map(function($line){
                return $line['amount'] * $line['price'];
            }, session()->get('cart'));
            $cartItems = array_sum($cartItems);
            return view('checkout', compact('cartItems'));

        } catch (\Exception $e) {
            session()->forget('pagseguro_session_code');
            redirect()->route('checkout.index');
        }
    }

    public function proccess(Request $request)
    {

        try {

            //TO-DO: validar se tipo de pagamento enviado é válido e aceito internamente...

            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = Uuid::uuid4();

            $payment = $dataPost['paymentType'] == 'BOLETO'
                ? new Boleto($cartItems, $user, $reference, $dataPost['hash'])
                : new CreditCard($cartItems, $user, $dataPost, $reference);


            $result = $payment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => $cartItems,
                'type' => $dataPost['paymentType'],
                'link_boleto' => $dataPost['paymentType'] == 'BOLETO' ? $result->getPaymentLink() : 'compra com cartão'

            ];
            $userOrder = $user->orders()->create($userOrder);
            $userOrder->stores()->sync($stores);

            event(new \App\Events\UserOrderItems($userOrder));

            //Envia notificação para a loja informando sobre o pedido
            $store = (new Store())->notifyStoreOwners($stores);
            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            $dataJson = [
                'status' => true,
                'message' => 'Seu pedido está sendo processado!',
                'order'   => $reference
            ];
            if($dataPost['paymentType'] == 'BOLETO') {
                $dataJson['link_boleto'] = $result->getPaymentLink();
            }
            return response()->json([
                'data' => $dataJson
            ]);

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido!';

            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        try {
            $notification = new Notification();
            $notification = ($notification)->getTransaction();
            $reference = base64_decode($notification->getReference());
            //Atualizar o pedido do usuário
            $userOrder = UserOrder::whereReference($reference);
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);
             //comentário sobre o pedido pago
             if($notification->getStatus() == 1){
                 $messager = 'Aguardando pagamento';
             }elseif($notification->getStatus() == 2){
                 //Em análise
                 $messager = 'Em análise';
             }elseif($notification->getStatus() == 3){
                 //Paga
                 $messager = 'Pagamento realizado com sucesso';
             }elseif($notification->getStatus() == 4){
                 //Disponível para o vendedor sacar
                 $messager = 'Valor da compra disponibilizado para o vendedor';
             }elseif($notification->getStatus() == 5){
                 //Em disputa
                 $messager = 'Em disputa';

             }elseif($notification->getStatus() == 6){
                 //Devolvida ao comprador
                 $messager = 'Valor devolvido ao comprador';
             }elseif($notification->getStatus() == 7){
                 //Compra Cancelada
                 $messager = 'Cancelado';
             }elseif($notification->getStatus() == 8){
                 //Debitado
                 $messager = 'Debitado';
             }elseif($notification->getStatus() == 9) {
                 //Retenção Temporária
                 $messager = 'Retenção temporária';

             }else{
                 //Sem status - Aguarde
                 $messager = 'Aguarde';
             }
             return response()->json([$notification->getStatus(), $messager], 204);
         }catch (\Exception $e){
             $message = env('APP_DEBUG') ? $e->getMessage() : '';
             return response()->json(['error'=> $message], 500);
         }
    }

    private function makePagSeguroSession()
    {
        if(!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
        }
        return session()->put('pagseguro_session_code', $sessionCode->getResult());
    }

}
