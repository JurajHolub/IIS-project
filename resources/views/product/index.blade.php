@extends ('layouts.app')

@section ('title', 'Products')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <form method="GET" action="products">
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
            @if(Auth::user() && \App\Enums\UserRole::manager(Auth::user()->role))
                <a class="btn btn-success btn-block" href="products/create">New product</a>
            @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="list-group">
                    @forelse($products as $product)
                        <div class="list-group-item my-link" id="ticket-{{ $product->id }}">
                            <h6>
                                <strong>
                                    <a href="products/{{ $product->id }}">{{ $product->title }}</a>
                                </strong>
                            </h6>
                            <p class="text-secondary my-0 py-0">
                                Version: <span class="font-weight-bold">{{ $product->version }}</span>
                            </p>
                            <p class="text-secondary my-0 py-0">
                                Actualized: <span class="font-weight-bold">{{ $product->updated_at->diffForHumans() }}</span>
                            </p>
                        </div>
                    @empty
                        <p>No products</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
