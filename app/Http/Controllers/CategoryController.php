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
    public function dashboard()
    {
        return view('dashboard');
    }

}
