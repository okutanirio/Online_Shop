<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\product;
use App\Consts\ProductConst;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
    $product = new Product;
    $all = $product->orderBy('created_at', 'desc')->take(8)->get();
    $types  = ProductConst::TYPE_LIST;
    return view('home', [
        'products'  => $all, 
        'types'     => $types
    ]);
    }
}
