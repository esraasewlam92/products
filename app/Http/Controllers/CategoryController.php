<?php

namespace App\Http\Controllers;



use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $categories = Category::get();
        return view('category',['categories'=>$categories]);
    }
    public function create()
    {
        return view('category-form',
            [
                'categories'   => Category::pluck('name', 'id')->toArray(),
                'active'=> trans('products.active'),
            ]);

    }
    public function store()
    {
        Category::create(request(['name','active', 'parent_id']));
        return redirect('category');
    }

    public function edit($id)
    {
        return view('category-form',
            [
                'category'=>Category::find($id),
                'categories'   => Category::pluck('name', 'id')->toArray(),
                'active'=> trans('products.active'),
            ]);

    }
    public function update($id)
    {
        Category::where('id', $id)->update(request(['name','active', 'parent_id']));
        return redirect('category');
    }
    public function delete($id)
    {
        Category::destroy($id);
        return redirect('category');
    }


    public function dashboard()
    {
        return view('dashboard');
    }

}
