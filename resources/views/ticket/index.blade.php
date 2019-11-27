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
            <div class="col-lg-1">
                <button class="btn btn-secondary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="col-lg-2 offset-lg-6">
                @if(Auth::user())
                    <a class="btn btn-success btn-block" href="/tickets/create">New issue</a>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="collapse" id="collapseExample">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-search"></i></div>
                        <form method="POST" action="/tickets/search" class="form-horizontal border p-3">
                            @csrf
                            <div class="row mt-1 mb-1">
                                <div class="col-2"><label>Search in ticket title</label></div>
                                <div class="col"><input name="ticket" id="ticket" class="form-control" type="text"/></div>
                            </div>
                            <div class="row mt-1 mb-1">
                                <div class="col-2"><label>Search by product</label></div>
                                <div class="col"><input name="product" id="product" class="form-control" type="text"/></div>
                            </div>
                            <div class="row mt-1 mb-1">
                                <div class="col-2"><label>Search by author</label></div>
                                <div class="col"><input name="author" id="author" class="form-control" type="text"/></div>
                            </div>
                            <div class="row mt-1 mb-1">
                                <div class="col-2"><label>State of issues</label></div>
                                <div class="col">
                                    @foreach(\App\Enums\TaskTicketState::MapFrom as $state)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="state[]"
                                                   value="{{ \App\Enums\TaskTicketState::MapTo[$state] }}" checked>
                                            <label class="form-check-label" for="state_id[]">{{ $state }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" id="submit" class="btn btn-success">Search</button>
                        </form>
                    </div>
                </div>
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
                                    <span class="pl-3"><i class="fa fa-comments"></i> <a
                                            href="/tickets/{{ $ticket->id }}#comment">{{ $ticket->comments->count() }} comments</a></span>
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
