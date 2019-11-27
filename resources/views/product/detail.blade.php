@extends('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <h1>{{ $product->title }}</h1>
                <h6><b>Version:</b> {{ $product->version }}</h6>
                <h6><b>Created:</b> {{ $product->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $product->updated_at }}</h6>
            </div>
            <div class="col-lg-2 offset-lg-7">
                @if(Auth::user() && \App\Enums\UserRole::manager(Auth::user()->role))
                <a class="btn btn-success btn-block" href="/products/{{ $product->id }}/edit">Edit</a>
                <form method="post" action="/products/{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success btn-block mt-1" >Delete</button>
                </form>
                @endif
            </div>
        </div>
        <h6><b>Description:</b></h6>
        <p class="p-1">{{ $product->description }}</p>
        <h3 id="part">Product parts:</h3>
        <div class="px-3">
            @forelse ($product->parts as $part)
                <div class="border row mb-3 pt-2">
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <h3 >{{ $part->title }}</h3>
                        <h6 ><b>Author:</b> {{ $part->author->login }}</h6>
                        <h6 ><b>Created:</b> {{ $part->created_at->format('d.m.Y - H:i') }}</h6>
                        <h6 > <b>Version:</b> {{ $part->version }}</h6>
                        <p > {{ $part->description }}</p>
                    </div>
                    <div class="col-lg-2 offset-lg-7 pt-3">
                        @if(Auth::user() && \App\Enums\UserRole::manager(Auth::user()->role))
                        <a class="btn btn-success btn-block" href="/products/{{ $product->id }}/parts/{{ $part->id }}/edit">Edit</a>
                        <form method="post" action="/products/{{ $product->id }}/parts/{{ $part->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success btn-block mt-1" >Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            @empty
                <p>No product parts.</p>
            @endforelse
        </div>
        @if(Auth::user() && \App\Enums\UserRole::director(Auth::user()->role))
        <div class="border p-1 mt-3">
            <h5>Add product part</h5>
            <form method="POST" action="/products/{{ $product->id }}/parts">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter title" autocomplete="off">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="version">Version</label>
                    <input name="version" type="text" class="form-control" id="version" placeholder="Enter version" autocomplete="off">
                    @error('version')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <textarea class="form-control mb-1" rows="2" id="description" name="description" placeholder="Write description..."></textarea>
                <button type="submit" id="create" name="create" class="btn btn-success">Add product part</button>
            </form>
        </div>
        @endif
    </div>
@endsection
