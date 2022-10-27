<?php

namespace App\Http\Controllers;

use Afaqy\Core\Traits\FileProcessing;
use App\Models\Category;
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
    public function create()
    {
        return view('product-form',
            [
                'categories'   => Category::pluck('name', 'id')->toArray(),
            ]);

    }
    public function store()
    {
        $data = request(['name','category_id', 'photo', 'tags', 'description']);
        if (request()->hasFile('photo')) {
            $data['photo']      = FileProcessing::uploadFile(request(), 'public/products', 'photo');
        }
        Product::create($data);
        return redirect('product');
    }

    public function edit($id)
    {
        return view('product-form',
            [
                'product'    => Product::find($id),
                'products'   => Product::pluck('name', 'id')->toArray(),
            ]);

    }
    public function update($id)
    {
        Product::where('id', $id)->update(request(['name','category_id', 'photo', 'tags', 'description']));
        return redirect('product');
    }

    public function delete($id)
    {
        Product::destroy($id);
        return redirect('product');
    }

}
