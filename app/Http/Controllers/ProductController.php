<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->paginate(10);  //GET DATA DARI TABLE PRODUCT
        $category = Category::orderBy('created_at', 'DESC')->paginate(10); //GET DATA DARI COLLECTION MONGODB
        return view('welcome', compact('product', 'category'));
    }
    public function insertToMySQL(Request $request)
{
    $this->validate($request, [
        'title' => 'required|string',
        'price' => 'required|integer'
    ]);

    Product::create([
        'title' => $request->title,
        'price' => $request->price
    ]);
    return redirect()->back();
}

public function insertToMongo(Request $request)
{
    $this->validate($request, [
        'name' => 'required|string'
    ]);

    Category::create(['name' => $request->name]);
    return redirect()->back();
}
}
