<?php

namespace App\Http\Controllers;

use App\Category;
use App\Store;
use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    private $product, $category;
    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }
    public function index()
    {
        //Disparar o evento

        $products = $this->product->orderBy('id','DESC')->paginate(12);
        $stores = Store::limit(4)->orderBy('id','DESC')->paginate(4);
        return view('welcome', compact('products','stores'));
    }

    public function single($slug)
    {
        $product = $this->product->whereSlug($slug)->firstOrFail();

        $postal_code = preg_replace('/[^0-9]/', '', $product->store->user->postal_code);


        return view('single', compact('product','postal_code'));
    }


    public function search(Request $request)
    {
        $filter = $request['filter'];

        $results = Product::where(function ($query) use($filter){
            $query->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('body', 'LIKE', "%{$filter}%")->get();
        })->paginate(12);

        if ($results->items() != []) {
            flash('O sistema retornou os seguintes resultados para o termo ' . $filter)->success();
            return view('search', compact('results', 'filter'));
        } else {
            flash('Não temos o produto cadastrado!')->error();
            return redirect()->route('home');
        }


    }

    public function stores()
    {
        $stores = Store::orderBy('id','DESC')->paginate(12);
        return view('stores', compact('stores'));
    }



}
