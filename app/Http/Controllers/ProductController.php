<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $products = Product::get();
        return view('product',['products' => $products]);
    }

}
