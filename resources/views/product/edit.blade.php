@extends('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
        <div class="border p-1">
            <form method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" autocomplete="off"
                           value="{{ $product->title }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="version">Version</label>
                    <input name="version" type="text" class="form-control" id="version" autocomplete="off"
                           value="{{ $product->version }}">
                    @error('version')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <h6><b>Created:</b> {{ $product->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $product->updated_at }}</h6>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="5" id="description">{{ $product->description }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submit" class="btn btn-success">Update product</button>
            </form>
        </div>
    </div>
@endsection
