<?php

namespace App\Http\Controllers\Manager;

use App\Category;
use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;
use PDF;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->middleware('store.has.product')->only(['edit','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if(!$user->store()->exists()) {
            flash('É preciso criar uma loja para cadastrar produtos!')->warning();
            return redirect()->route('manager.stores.index');
        }

        $products = $user->store->products()->paginate(10);
        return view('manager.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['id','name']);
        return view('manager.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $categories = $request->get('categories',null);
        $data['price'] = formatValueToDataBase($data['price']);
        //$data['slug'] = $data['name'];

        $store = auth()->user()->store;
        $product = $store->products()->create($data);
        $product->categories()->sync($categories);
        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);
        }


        flash('Produto criado com sucesso!')->success();
        return redirect()->route('manager.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->findOrFail($product);
        $categories = \App\Category::all(['id','name']);

        return view('manager.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        $categories = $request->get('categories',null);


        $product = $this->product->find($product);
        $product->update($data);


        if(!is_null($categories)){
            $product->categories()->sync($categories);
        }

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
        }
        if(auth()->user()->role == "ADMINISTRATOR"){
            flash('O Produto, '.$product->name.', foi atualizado com sucesso!')->success();
            return redirect()->route('administrator.products.list');
        }else{
            flash('O Produto, '.$product->name.', foi atualizado com sucesso!')->success();
            return redirect()->route('manager.products.index');
        }

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function remove($product)
    {
        $product = $this->product->find($product);
        $name = $product['name'];
        $product->delete();
        flash('O Produto '.$name.' foi excluído com sucesso!')->error();
        return redirect()->back();
    }

    public function pdfProducts()
    {
        $user = auth()->user();
        $store= $user->store;
        $products = $user->store->products()->get();
        $pdf = PDF::loadView('pdf.manager.products', compact('products','store'));
        return $pdf->setPaper('a4','landscape')->stream('products-store.pdf');
    }



}
