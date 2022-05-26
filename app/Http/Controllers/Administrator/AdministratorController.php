<?php

namespace App\Http\Controllers\Administrator;

use App\Category;
use App\Http\Controllers\Controller;

use App\Product;
use App\Store;
use App\User;


class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('access.control.administrator')->only(['index']);
    }

    public function index(){
        $users = User::all()->count();
        $stores = Store::all()->count();
        $products = Product::all()->count();
        $categories = Category::all()->count();

        return view('administrator.index', compact('users', 'stores', 'products','categories'));
    }


    public static function graphicUsers()
    {
      //
    }

    public static function amount()
    {
        $users = User::all()->count();
        $stores = Store::all()->count();
        $products = Product::all()->count();
        $categories = Category::all()->count();
        return view('layout.administrator', compact('users', 'stores', 'products','categories'));
    }
}
