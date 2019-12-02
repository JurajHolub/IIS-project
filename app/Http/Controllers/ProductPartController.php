<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPart;
use App\Ticket;
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
            'manager_id' => ['required'],
        ]);

        $part = new ProductPart([
            'title' => $data['title'],
            'description' => $data['description'],
            'version' => $data['version'],
            'author_id' => Auth::id(),
            'manager_id' => $data['manager_id'],
            'product_id' => $product->id,
        ]);

        $part->save();
        return redirect('/products/'.$product->id);
    }

    public function edit(Product $product, \App\ProductPart $part)
    {
        $managers = User::whereIn(
            'role', [UserRole::Manager, UserRole::Director, UserRole::Admin])
            ->get();

        return view('product_part.edit', compact('product', 'part', 'managers'));
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

        return redirect('/products/'.$product->id);
    }

    public function destroy(Product $product, \App\ProductPart $part)
    {
        $part->delete();

        return redirect('/products/'.$product->id);
    }
}
