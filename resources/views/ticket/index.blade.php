@extends ('layouts.app')

@section ('title', 'Tickets')

@section('content')
    <div class="container">

        <div class="list-group">
            @forelse($tickets as $ticket)
                <div class="list-group-item my-link" id="ticket-{{ $ticket->id }}">
                    <strong><a href="tickets/{{ $ticket->id }}">{{ $ticket->title }}</a></strong>
                    <p class="info mb-0 mt-3 p-0">
                        Opened by <a href="#">{{ $ticket->author->login }}</a>
                        {{ $ticket->updated_at->diffForHumans() }}
                        <span class="pl-3"><i class="fa fa-comments"></i> <a href="#">14 comments</a></span>
                    </p>
                </div>
            @empty
                <p>No tickets</p>
            @endforelse
        </div>
    </div>
@endsection
