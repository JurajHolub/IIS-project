@extends('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
        <h1>{{ $product->title }}</h1>
        <h6><b>Version:</b> {{ $product->version }}</h6>
        <h6><b>Created:</b> {{ $product->created_at }}</h6>
        <h6><b>Last actualized:</b> {{ $product->updated_at }}</h6>
        <div class="border">
            <h6><b>Description:</b></h6>
            <p >{{ $product->description }}</p>
        </div>
        <h3 id="part">Product parts:</h3>
        <div class="list-group">
            @foreach ($product->parts as $part)
                <a class="list-group-item">
                    <h3 class="list-group-item-heading">{{ $part->title }}</h3>
                    <h6 class="list-group-item-heading"><b>Author:</b> {{ $part->author->login }}</h6>
                    <h6 class="list-group-item-heading"><b>Created:</b> {{ $part->created_at->format('d.m.Y - H:i') }}</h6>
                    <h6 class="list-group-item-heading"> <b>Version:</b> {{ $part->version }}</h6>
                    <p class="list-group-item-text"> {{ $part->description }}</p>
                </a>
            @endforeach
        </div>
        <div class="border pt-3">
            <form method="POST" action="/product_parts">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                <textarea class="form-control" rows="2" id="description" name="description" placeholder="Write description..."></textarea>
                <button type="submit" id="submit" class="btn btn-success">Add product part</button>
            </form>
        </div>
    </div>
    </div>
@endsection
