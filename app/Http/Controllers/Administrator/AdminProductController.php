<?php

namespace App\Http\Controllers\Administrator;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use PDF;

class AdminProductController extends Controller
{
    private $product;
    private $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        //$this->middleware('access.control.administrator')->only(['index','listUsers','listProducts','listStores','listCategories']);
        $this->category = $category;
    }

    public function listProducts()
    {
        $products = $this->product->orderBy('name', 'ASC')->paginate(20);
        $categories = $this->category->orderBy('name', 'ASC')->get();
        return view('administrator.products', compact('products','categories'));


    }
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $products = $this->product->search($request->filter);
        return view('administrator.products', compact('products','filters'));

    }

    /*public function productsCategory($category)
    {
        $products = $this->product->categories($category)->orderBy('name', 'ASC')->paginate(20);

        dd($products);

        return view('administrator.products', compact('products'));

    }*/
    public function pdfProducts()
    {
        $products = $this->product->get();
        $pdf = PDF::loadView('pdf.administrator.products', compact('products'));
        return $pdf->setPaper('a4','landscape')->stream('report-products.pdf');

    }
}
