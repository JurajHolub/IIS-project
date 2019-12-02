@extends('layouts.app')

@section ('title', 'ProductParts')

@section('content')
    <div class="container">
        <div class="border p-1 mb-5">
            <h1>{{ $product->title }}</h1>
            <h6><b>Version:</b> {{ $product->version }}</h6>
            <h6><b>Created:</b> {{ $product->created_at }}</h6>
            <h6><b>Last actualized:</b> {{ $product->updated_at }}</h6>
            <h6><b>Description:</b></h6>
            <p class="p-1">{{ $product->description }}</p>
        </div>
        <div class="border p-1">
            <h4>Update product part</h4>
            <form method="post" action="/products/{{ $product->id }}/parts/{{ $part->id }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="title"><b>Title</b></label>
                    <input name="title" type="text" class="form-control" id="title" autocomplete="off"
                           value="{{ $part->title }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="version"><b>Version</b></label>
                    <input name="version" type="text" class="form-control" id="version" autocomplete="off"
                           value="{{ $part->version }}">
                    @error('version')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="manager" >Manager:</label>
                    <select class="form-control" id="manager" name="manager">
                        @foreach ($managers as $manager)
                            <option value="{{ $manager->id }}">{{ $manager->login }}</option>
                        @endforeach
                    </select>
                </div>
                <h6><b>Created:</b> {{ $part->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $part->updated_at }}</h6>
                <div class="form-group">
                    <label for="description"><b>Description</b></label>
                    <textarea name="description" class="form-control" rows="5" id="description">{{ $part->description }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection
