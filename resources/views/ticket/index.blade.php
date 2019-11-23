@extends ('layouts.app')

@section ('title', 'Tickets')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <form method="GET" action="">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Sort:</span>
                        </div>
                        <select class="form-control" id="sel1" name="sort" onchange="this.form.submit()">
                            <option @if ( $sort == "recently_updated" ) selected @endif>Recently updated</option>
                            <option @if ( $sort == "newest" ) selected @endif>Newest</option>
                            <option @if ( $sort == "oldest" ) selected @endif>Oldest</option>
                            <option @if ( $sort == "most_commented" ) selected @endif>Most commented</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 offset-lg-7">
                <a class="btn btn-success btn-block" href="/tickets/create">New issue</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="list-group">
                    @forelse($tickets as $ticket)
                        <div class="list-group-item my-link" id="ticket-{{ $ticket->id }}">
                            <strong><a href="/tickets/{{ $ticket->id }}">{{ $ticket->title }}</a></strong>
                            <p class="info mb-0 mt-3 p-0">
                                Opened by <a href="#">{{ $ticket->author->login }}</a>
                                {{ $ticket->updated_at->diffForHumans() }}
                                @if ( $ticket->comments->count() > 0 )
                                    <span class="pl-3"><i class="fa fa-comments"></i> <a href="/tickets/{{ $ticket->id }}#comment">{{ $ticket->comments->count() }} comments</a></span>
                                @endif
                            </p>
                        </div>
                    @empty
                        <p>No tickets</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
