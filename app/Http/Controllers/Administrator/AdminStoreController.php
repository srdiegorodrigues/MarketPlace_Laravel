<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\OrdersController;
use App\Store;
use App\UserOrder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use PDF;

class AdminStoreController extends Controller
{
    private $store;

    use SoftDeletes;

    public function __construct(Store $store)
    {
        $this->store = $store;
        $this->middleware('access.control.administrator')->only(['listStores','search','pdfStores']);
    }

    public function listStores()
    {

        $stores = $this->store->orderBy('name', 'ASC')->paginate(20);
        return view('administrator.stores', compact('stores'));

    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $stores = $this->store->search($request->filter);
        return view('administrator.stores', compact('stores','filters'));

    }

    public function pdfStores()
    {
        $stores = $this->store->get();
        $pdf = PDF::loadView('pdf.administrator.stores', compact('stores'));
        return $pdf->setPaper('a4','landscape')->stream('report-stores.pdf');

    }

}
