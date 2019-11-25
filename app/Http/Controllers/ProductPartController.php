<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPartController extends Controller
{
    public function store(Product $product)
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'version' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $part = new ProductPart([
            'title' => $data['title'],
            'description' => $data['description'],
            'version' => $data['version'],
            'author_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        $part->save();
        return redirect('/products/'.$product->id.'/edit');
    }

    public function edit(Product $product, \App\ProductPart $part)
    {
        return view('product.edit', compact('product'));
    }

    public function update(\App\Product $product, \App\ProductPart $part)
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'version' => ['required', 'string'],
        ]);

        $part->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'version' => $data['version'],
            'author_id' => Auth::id(),
        ]);

        return back();
    }

    public function destroy(Product $product, \App\ProductPart $productPart)
    {
        $productPart->delete();

        return back();
    }
}
