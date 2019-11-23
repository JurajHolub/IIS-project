@extends('layouts.app')

@section ('title', 'Tickets')

@section('content')
    <div class="container">
        <h1>{{ $ticket->title }}</h1>
        <h6><b>Priority:</b> {{ $ticket->priority }}</h6>
        <h6><b>State:</b> {{ $ticket->state }}</h6>
        <h6><b>Created:</b> {{ $ticket->created_at }}</h6>
        <h6><b>Last actualized:</b> {{ $ticket->updated_at }}</h6>
        <div class="border">
            <h6><b>Description:</b></h6>
            <p >{{ $ticket->description }}</p>
        </div>
        <br>
        <h3>Comments</h3>
        <div class="list-group">
            @foreach ($comments as $comment)
                <a class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $comment->id }}</h4>
                    <h6 class="list-group-item-heading">{{ $comment->created_at }}</h6>
                    <p class="list-group-item-text"> {{ $comment->description }}</p>
                </a>
            @endforeach
            <a class="list-group-item">
                <h4 class="list-group-item-heading">jurko</h4>
                <h6 class="list-group-item-heading">1.1.2019 - 09:28</h6>
                <p class="list-group-item-text">
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </a>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">peto</h4>
                <h6 class="list-group-item-heading">1.1.2019 - 09:28</h6>
                <p class="list-group-item-text">
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </a>
            <a class="list-group-item">
                <h4 class="list-group-item-heading">fero</h4>
                <h6 class="list-group-item-heading">1.1.2019 - 09:28</h6>
                <p class="list-group-item-text">
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </a>
        </div>
        <div class="border pt-3">
            <form>
                <textarea class="form-control" rows="2" id="comment" name="comment" placeholder="Write comment..."></textarea>
                <button type="submit" id="submit" class="btn btn-success">Post</button>
            </form>
        </div>
    </div>
@endsection
