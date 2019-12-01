@extends('layouts.app')

@section ('title', 'Tickets')

@section('content')
    <div class="container">
        <div class="card card-body">
            <form method="POST" action="{{ route('issues') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           placeholder="Enter title" value="{{ old('title') }}" autocomplete="off">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select id="priority" class="form-control" name="priority">
                        <option
                            {{ old('priority', 1) == 1 ? 'selected' : '' }}>1
                        </option>
                        <option
                            {{ old('priority', 1) == 2 ? 'selected' : '' }}>2
                        </option>
                        <option
                            {{ old('priority', 1) == 3 ? 'selected' : '' }}>3
                        </option>
                        <option
                            {{ old('priority', 1) == 4 ? 'selected' : '' }}>4
                        </option>
                        <option
                            {{ old('priority', 1) == 5 ? 'selected' : '' }}>5
                        </option>
                        <option
                            {{ old('priority', 1) == 6 ? 'selected' : '' }}>6
                        </option>
                        <option
                            {{ old('priority', 1) == 7 ? 'selected' : '' }}>7
                        </option>
                        <option
                            {{ old('priority', 1) == 8 ? 'selected' : '' }}>8
                        </option>
                        <option
                            {{ old('priority', 1) == 9 ? 'selected' : '' }}>9
                        </option>
                        <option
                            {{ old('priority', 1) == 10 ? 'selected' : '' }}>10
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <div>Products:</div>
                    <div class="border p-1 mt-2">
                    @foreach ($products as $product)
                        @foreach ($product->parts as $part)
                            <div class="form-check">
                                <input id="product_part_{{ $part->id }}" type="checkbox" class="form-check-input"
                                       name="product_part_id[]" value="{{ $part->id }}"
                                       @if(is_array(old('product_part_id')) && in_array($part->id, old('product_part_id'))) checked @endif/>
                                <label class="form-check-label" for="product_part_{{ $part->id }}">
                                    {{ $product->title }} - {{ $part->title }}
                                </label>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                @error('product_part_id')
                <div class="alert alert-danger">Please select product</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                              name="description" rows="5"
                              placeholder="Describe your issue...">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Include images</label>
                    <input name="image" type="file" class="form-control-file" id="image">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection
