<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use function Sodium\compare;

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
        $managers = User::whereIn(
            'role', [UserRole::Manager, UserRole::Director, UserRole::Admin])
            ->get();
        $product = Product::find($id);
        return view('product.detail', compact('product', 'managers'));
    }

    public function edit(\App\Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(\App\Product $product)
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'version' => ['required', 'string'],
        ]);

        $product->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'version' => $data['version'],
            'author_id' => Auth::id(),
        ]);

        return $this->show($product->id);
    }

    public function destroy(\App\Product $product)
    {
        $product->delete();
        return redirect('/products');
    }

}
