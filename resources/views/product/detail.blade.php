@extends('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $product->title }}</h1>
                <hr class="my-2">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 mb-3 mb-lg-0 order-lg-2">
                @if(Auth::user() && \App\Enums\UserRole::manager(Auth::user()->role))
                    <a class="btn btn-success btn-block" href="/products/{{ $product->id }}/edit">Edit</a>
                    <form method="post" action="/products/{{ $product->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success btn-block mt-1">Delete</button>
                    </form>
                @endif
            </div>
            <div class="col mb-3 mb-lg-0 order-lg-1">
                <h6><b>Version:</b> {{ $product->version }}</h6>
                <h6><b>Created:</b> {{ $product->created_at->format('G:i, j F y') }}</h6>
                <h6><b>Actualized:</b> {{ $product->updated_at->format('G:i, j F y') }}</h6>
            </div>
        </div>
        <h6><b>Description:</b></h6>
        <p class="ml-2 mt-0 mb-2 py-0">{{ $product->description }}</p>
        <h6 id="part"><strong>Product parts:</strong></h6>
        <div class="list-group ml-2">
            @foreach ($product->parts as $part)
                <div class="list-group-item my-1">
                    <div class="row">
                        <div class="col">
                            <h4>{{ $part->title }}</h4>
                            <hr class="my-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 mb-lg-0">
                            <h6><b>Author:</b> {{ $part->author->login }}</h6>
                            <h6><b>Actualized:</b> {{ $part->updated_at->format('G:i, j F y') }}</h6>
                            <h6><b>Created:</b> {{ $part->created_at->format('G:i, j F y') }}</h6>
                            <h6><b>Version:</b> {{ $part->version }}</h6>
                            <h6><b>Description:</b></h6>
                            <p class="ml-2 my-0 py-0"> {{ $part->description }}</p>
                        </div>
                        <div class="col-lg-2">
                            @if(Auth::user() && \App\Enums\UserRole::manager(Auth::user()->role))
                                <a class="btn btn-success btn-block"
                                   href="/products/{{ $product->id }}/parts/{{ $part->id }}/edit">Edit</a>
                                <form method="post" action="/products/{{ $product->id }}/parts/{{ $part->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-success btn-block mt-1">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
                @if(Auth::user() && \App\Enums\UserRole::director(Auth::user()->role))
                    <div class="list-group-item my-1">
                        <div class="row">
                            <div class="col">
                                <h4>Add product part</h4>
                                <hr class="my-2">
                                <form method="POST" action="/products/{{ $product->id }}/parts">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-1" for="title">Title</label>
                                            <div class="col">
                                                <input name="title" type="text"
                                                       class="form-control @error('title') is-invalid @enderror" id="title"
                                                       placeholder="Enter title" autocomplete="off" value="{{ old('title') }}">
                                            </div>
                                        </div>
                                        @error('title')
                                        <div class="row">
                                            <div class="col-md-11 offset-md-1">
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            </div>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-1" for="version">Version</label>
                                            <div class="col">
                                                <input name="version" type="text"
                                                       class="col form-control @error('version') is-invalid @enderror" id="version"
                                                       placeholder="Enter version" autocomplete="off"
                                                       value="{{ old('version') }}">
                                            </div>
                                        </div>
                                        @error('version')
                                        <div class="row">
                                            <div class="col-md-11 offset-md-1">
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            </div>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                      rows="2" id="description" name="description"
                                                      placeholder="Write description...">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <button type="submit" id="create" name="create" class="btn btn-success">
                                                Add product part
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
@endsection
