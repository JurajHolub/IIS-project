@extends('layouts.app')

@section ('title', 'Tickets')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <h1>{{ $ticket->title }}</h1>
                <h6><b>Priority:</b> {{ $ticket->priority }}</h6>
                <h6><b>State:</b> {{ $ticket->state }}</h6>
                <h6><b>Created:</b> {{ $ticket->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $ticket->updated_at }}</h6>
            </div>
            <div class="col-lg-2 offset-lg-7">
                <a class="btn btn-success btn-block" href="/tickets/{{ $ticket->id }}/edit">Edit</a>
                <form method="post" action="/tickets/{{ $ticket->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success btn-block mt-1" >Delete</button>
                </form>
            </div>
        </div>
        <h6><b>Products:</b></h6>
        <div class="list-group">
            @foreach ($ticket->product_parts as $part)
                <a class="list-group-item">
                    <h6 class="list-group-item-heading">
                        {{ $part->product->title }} - {{ $part->title }}
                    </h6>
                </a>
            @endforeach
        </div>
        <h6><b>Description:</b></h6>
        <p >{{ $ticket->description }}</p>
        <br>
        <h3 id="comment">Comments</h3>
        <div class="list-group">
            @foreach ($ticket->comments as $comment)
                <a class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $comment->author->login }}</h4>
                    <h6 class="list-group-item-heading">{{ $comment->created_at->format('d.m.Y - H:i') }}</h6>
                    <p class="list-group-item-text"> {{ $comment->description }}</p>
                </a>
            @endforeach
        </div>
        <div class="border p-2">
            <form method="POST" action="/comments">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <textarea class="form-control" rows="2" id="comment" name="comment" placeholder="Write comment..."></textarea>
                <button type="submit" id="submit" class="btn btn-success">Post</button>
            </form>
        </div>
    </div>
@endsection
