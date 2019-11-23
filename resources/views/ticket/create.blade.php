@extends('layouts.app')

@section ('title', 'Tickets')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('issues') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Enter title" autocomplete="off">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="5" id="description" placeholder="Describe your issue..."></textarea>
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
@endsection
