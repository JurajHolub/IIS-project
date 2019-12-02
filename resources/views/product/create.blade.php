@extends('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('products') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter product title" autocomplete="off" value="{{ old('title') }}">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="version">Version</label>
                <input name="version" class="form-control @error('version') is-invalid @enderror" id="version" placeholder="Enter version" autocomplete="off" value="{{ old('version') }}">
                @error('version')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" id="description" placeholder="Describe product...">{{ old('description') }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" id="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
