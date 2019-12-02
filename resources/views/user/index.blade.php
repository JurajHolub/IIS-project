@extends ('layouts.app')

@section ('title', 'Users')

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
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 offset-lg-7">
                <a class="btn btn-success btn-block" href="create">New user</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="list-group">
                    @forelse($users as $user)
                        <div class="list-group-item my-link" id="user-{{ $user->id }}">
                            <strong><a href="{{ $user->id }}">{{ $user->login }}</a></strong>
                            <p class="info mb-0 mt-3 p-0">
                                Last updated: {{ $user->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    @empty
                        <p>No users</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
