@extends('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <h1>{{ $product->title }}</h1>
            </div>
            <div class="col-lg-2 offset-lg-7">
                <a class="btn btn-success btn-block" href="/products/{{ $product->id }}/edit">Edit</a>
                <form method="post" action="/products/{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success btn-block mt-1" >Delete</button>
                </form>
            </div>
        </div>
        <h6><b>Version:</b> {{ $product->version }}</h6>
        <h6><b>Created:</b> {{ $product->created_at }}</h6>
        <h6><b>Last actualized:</b> {{ $product->updated_at }}</h6>
        <h6><b>Description:</b></h6>
        <p class="p-1">{{ $product->description }}</p>
        <h3 id="part">Product parts:</h3>
        <div>
            @forelse ($product->parts as $part)
                <div class="border p-2 mb-2">
                    <h3 >{{ $part->title }}</h3>
                    <h6 ><b>Author:</b> {{ $part->author->login }}</h6>
                    <h6 ><b>Created:</b> {{ $part->created_at->format('d.m.Y - H:i') }}</h6>
                    <h6 > <b>Version:</b> {{ $part->version }}</h6>
                    <p > {{ $part->description }}</p>
                </div>
            @empty
                <p>No product parts.</p>
            @endforelse
        </div>
    </div>
    </div>
@endsection
