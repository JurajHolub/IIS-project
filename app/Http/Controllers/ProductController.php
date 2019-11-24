<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $request = request()->validate([
            'sort' => ['string']
        ]);

        if (!isset($request["sort"]) || $request["sort"] === "Newest")
        {
            $products = Product::orderBy('created_at', 'desc')->get();
            $sort = "newest";
        }
        elseif ($request["sort"] === "Oldest") {
            $products = Product::orderBy('created_at', 'asc')->get();
            $sort = "oldest";
        }
        else
        {
            $products = Product::orderBy('updated_at', 'desc')->get();
            $sort = "recently_updated";
        }


        return view('product.index', compact('products','sort'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'version' => ['required', 'string'],
        ]);

        $product = new Product([
            'title' => $data['title'],
            'description' => $data['description'],
            'version' => $data['version'],
            'author_id' => Auth::id(),
        ]);

        $product->save();

        return redirect('/products/'.$product->id);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('product.detail', compact('product'));
    }

}
