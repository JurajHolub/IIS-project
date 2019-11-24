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
    </div>
@endsection
