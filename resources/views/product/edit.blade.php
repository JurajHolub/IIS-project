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
        <div class="mt-3">
            <h3 id="part">Product parts:</h3>
            @foreach ($product->parts as $part)
                <div class="border p-1">
                    <form method="post" action="/products/{{ $product->id }}/parts/{{ $part->id }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title" autocomplete="off"
                                   value="{{ $part->title }}">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="version">Version</label>
                            <input name="version" type="text" class="form-control" id="version" autocomplete="off"
                                   value="{{ $part->version }}">
                            @error('version')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <h6><b>Created:</b> {{ $part->created_at }}</h6>
                        <h6><b>Last actualized:</b> {{ $part->updated_at }}</h6>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="5" id="description">{{ $part->description }}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                    <form method="post" action="/products/{{ $product->id }}/parts/{{ $part->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success mt-1" >Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="border p-1 mt-3">
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
                <textarea class="form-control" rows="2" id="description" name="description" placeholder="Write description..."></textarea>
                <button type="submit" id="create" name="create" class="btn btn-success">Add product part</button>
            </form>
        </div>
    </div>
@endsection
