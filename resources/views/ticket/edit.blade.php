@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="border p-1">
            <form method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" autocomplete="off"
                           value="{{ $ticket->title }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <select class="form-control" id="state" name="state">
                        @foreach(\App\Enums\TaskTicketState::MapFrom as $state)
                            <option value="{{ \App\Enums\TaskTicketState::MapTo[$state]}}"
                                    @if($ticket->state === \App\Enums\TaskTicketState::MapTo[$state])
                                    selected
                                @endif
                            >{{ $state }}</option>
                        @endforeach
                    </select>
                    @error('state')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <h6><b>Author:</b> {{ $ticket->author->login }}</h6>
                <h6>Assigned to products:</h6>
                <div class="border">
                    @foreach ($product_parts as $product_part)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="product_part_id[]" value="{{ $product_part->id }}"
                                   @if($product_part->ticket->contains($ticket))
                                   checked
                                @endif
                            >
                            <label class="form-check-label" for="ticket_id[]">
                                {{ $product_part->product->title }} - {{ $product_part->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <h6><b>Created:</b> {{ $ticket->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $ticket->updated_at }}</h6>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="5" id="description">{{ $ticket->description }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submit" class="btn btn-success">Update ticket</button>
            </form>
        </div>
    </div>
@endsection
