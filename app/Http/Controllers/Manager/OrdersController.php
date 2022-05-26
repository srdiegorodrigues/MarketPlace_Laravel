<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;
use PDF;


class OrdersController extends Controller
{
    private $order;

    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $user = auth()->user();

        if(!$user->store()->exists()) {
            flash('É preciso criar uma loja para ver pedidos!')->error();
            return redirect()->route('manager.stores.index');
        }

        $orders = auth()->user()->store->orders()->paginate(10);
        return view('manager.orders.index',compact('orders'));
    }

    public function pdfOrdersStore()
    {

        $orders = auth()->user()->store->orders()->get();
        $customPaper = array(0,0,950,950);

        $pdf = PDF::loadView('pdf.manager.orders', compact('orders'));
        return $pdf->setPaper('a3','landscape')->stream('orders-store.pdf');

    }
    public function pdfOrderUser($order)
    {
        $order = UserOrder::find($order);

        $pdf = PDF::loadView('pdf.manager.order', compact('order'));
        return $pdf->setPaper('a4')->stream('order-'.$order->reference.'.pdf');

    }





}
