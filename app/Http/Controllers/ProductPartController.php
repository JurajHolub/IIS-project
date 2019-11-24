<?php

namespace App\Http\Controllers;

use App\ProductPart;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductPartController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'product_id' => ['required', 'numeric', 'integer'],
            'title' => ['required', 'string'],
            'version' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $part = new ProductPart([
            'title' => $data['title'],
            'description' => $data['description'],
            'version' => $data['version'],
            'author_id' => Auth::id(),
            'product_id' => $data['product_id'],
        ]);

        $part->save();
        return redirect('/products/'.$data['product_id']."#part");
    }
}
