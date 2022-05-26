<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //condicional na variavel
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('cart',compact('cart'));
    }

    public function add(Request $request)
    {
        $productData = $request->get('product');
        $product = Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount']<=0)
            return redirect()->route('home');

        $product = array_merge($productData, $product->first(['id','name','price','store_id'])->toArray());

        //verificar se exite sessão para os produtos
        if(session()->has('cart')){
            //se existir, eu adiciono o produto na sessão

            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');
            if(in_array($product['slug'], $productsSlugs)){
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            }else{
                session()->push('cart',$product);
            }

        }else{
            //caso a sessão não exista, eu a crio com o primeiro produto adicionado
            $products[] = $product;
            session()->put('cart',$products);
        }


        //return redirect()->route('product.single',['slug'=>$product['slug']]);
        flash('O seguinte produto: '. $product['name'] . ', foi adicionado no carrinho!')->success();
        return back();

    }
    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function ($line) use($slug, $amount){
            if($slug == $line['slug']){
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);
        return $products;
    }


    public function remove ($slug)
    {
        if(!session()->has('cart'))
        {
            return redirect()->route('cart.index');
        }
        $products = session()->get('cart');

        $products = array_filter($products, function($line) use($slug){
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        flash('O produto foi removido do carrinho!')->warning();
        return redirect()->route('cart.index');

    }
    public function removeItem(Request $request)
    {
        $productData = $request->get('product');

        if($productData['amount'] <= 1){
            return $this->remove($productData['slug']);
        }
        $product = Product::whereSlug($productData['slug']);
        $product = array_merge($productData, $product->first(['id','name','price','store_id'])->toArray());
        $products = session()->get('cart');
        $productsSlugs = array_column($products, 'slug');
        if(in_array($product['slug'], $productsSlugs)){
            $products = $this->productDecrement($product['slug'], $product['amount'], $products);
            flash('Você removeu um item do '. $product['name'] . ', de seu carrinho!')->warning();
            session()->put('cart', $products);
        }
        return redirect()->route('cart.index');
    }

    private function productDecrement($slug, $amount, $products)
    {
        $products = array_map(function ($line) use($slug, $amount){
            if($slug == $line['slug']){
                $line['amount'] -= 1;
            }
            return $line;
        }, $products);
        return $products;
    }

    public function cancel()
    {
        session()->forget('cart');
        flash('Desistência da compra realizada com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    public function deliveryAddress()
    {
        $user = auth()->user();
        if($user->street == null and $user->postal_code == null){
            flash('Edite seu perfil e cadastre um endereço de entrega')->warning();
            return view('user.user-edit', compact('user'));
        }
        return redirect()->route('checkout.index');

    }

}
