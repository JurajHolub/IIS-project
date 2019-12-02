@extends('layouts.app')

@section ('title', 'Users')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <h1>{{ $user->login }}</h1>
            </div>
            <div class="col-lg-2 offset-lg-7">
                <a class="btn btn-success btn-block" href="{{ $user->id }}/edit">Edit</a>
                <form method="post" action="{{ $user->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success btn-block mt-1" >Delete</button>
                </form>
            </div>
        </div>
        <h6><b>Role:</b> {{ \App\Enums\UserRole::MapFrom[$user->role] }}</h6>
        <h6><b>Name:</b> {{ $user->name }}  {{$user->surname}}</h6>
        <h6><b>Email:</b> {{ $user->email }}</h6>
        <h6><b>Created:</b> {{ $user->created_at }}</h6>
        <h6><b>Last actualized:</b> {{ $user->updated_at }}</h6>
    </div>
@endsection
