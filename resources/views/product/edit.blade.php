@extends('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
            <form method="post" action="..">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" autocomplete="off"
                           value="{{ old('title', $product->title) }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="version">Version</label>
                    <input name="version" type="text" class="form-control @error('version') is-invalid @enderror" id="version" autocomplete="off"
                           value="{{ old('version', $product->version) }}">
                    @error('version')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" id="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submit" class="btn btn-success">Update product</button>
            </form>
    </div>
@endsection
