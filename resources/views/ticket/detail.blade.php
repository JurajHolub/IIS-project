@extends('layouts.app')

@section ('title', 'Tickets')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><h1>{{ $ticket->title }}</h1></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 mb-3 mb-lg-0 order-lg-2">
                                @if(Auth::user() && (Auth::user()->isAuthorOfTicket($ticket->id) || Auth::user()->isManager()))
                                    <a class="btn btn-success btn-block" href="tickets/{{ $ticket->id }}/edit">Edit</a>
                                    <form method="post" action="tickets/{{ $ticket->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-success btn-block mt-1">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <div class="col mb-3 mb-lg-0 order-lg-1">
                                <h6><b>Priority:</b> {{ $ticket->priority }}</h6>
                                <h6><b>State:</b> <span class="badge {{ \App\Enums\TicketStateToBootstrapBadge::Map[$ticket->state] }}">{{ \App\Enums\TaskTicketState::MapFrom[$ticket->state] }}</span></h6>
                                <h6><b>Author:</b> {{ $ticket->author->login }}</h6>
                                <h6><b>Actualized:</b> {{ $ticket->updated_at->format('G:i, j F y') }}</h6>
                                <h6><b>Created:</b> {{ $ticket->created_at->format('G:i, j F y') }}</h6>
                            </div>
                        </div>
                        <h6><b>Products:</b></h6>
                        <div class="list-group mb-2 ml-2">
                            @foreach ($ticket->product_parts as $part)
                                <a class="list-group-item">
                                    <h6 class="list-group-item-heading">
                                        {{ $part->product->title }} - {{ $part->title }}
                                    </h6>
                                </a>
                            @endforeach
                        </div>
                        <h6><b>Description:</b></h6>
                        <p class="ml-2">{{ $ticket->description }}</pclas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card" id="comments">
                    <div class="card-body p-0">
                        <h3 class="mx-3 my-3 p-0">Comments</h3>
                        @if(Auth::user())
                            <div class="border p-2 m-2">
                                <form method="POST" action="../comments">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <div class="form-group m-0 mb-1 p-0">
                                        <textarea class="form-control" rows="2" id="comment" name="comment"
                                                  placeholder="Write comment..."></textarea>
                                    </div>
                                    <div class="form-group m-0 p-0">
                                        <button type="submit" id="submit" class="btn btn-success">Post</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="list-group m-2">
                            @foreach ($ticket->comments as $comment)
                                <div class="list-group-item my-1">
                                    <h4 class="list-group-item-heading">{{ $comment->description }}</h4>
                                    <p class="info mb-0 mt-3 p-0"> by  <a href="#">{{ $comment->author->login }}</a> {{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
