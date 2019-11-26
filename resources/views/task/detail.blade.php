@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-3 mb-3 mb-lg-0">
                <h1>{{ $task->title }}</h1>
                <h6><b>State:</b> {{ \App\Enums\TaskTicketState::MapFrom[$task->state] }}</h6>
                <h6><b>Created:</b> {{ $task->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $task->updated_at }}</h6>
                <h6><b>Assigned hours to fix:</b> {{ $task->allocated_hours }}</h6>
                <h6><b>Already spent hours:</b> {{ $task->spent_hours }}</h6>
                <h6><b>Managed by:</b> {{ $task->manager->login }}</h6>
            </div>
            <div class="col-lg-2 offset-lg-7">
                <a class="btn btn-success btn-block" href="/tasks/{{ $task->id }}/edit">Edit</a>
                <form method="post" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success btn-block mt-1" >Delete</button>
                </form>
            </div>
        </div>
        <h6><b>Assigned to employees:</b></h6>
        <ul class="list-group">
            @forelse($task->employees as $employee)
                <li class="list-group-item">{{ $employee->login }}</li>
            @empty
                <li class="list-group-item"> Not assigned.</li>
            @endforelse
        </ul>
        <h6><b>Assigned to tickets:</b></h6>
        <ul class="list-group">
            @forelse($task->tickets as $ticket)
                <li class="list-group-item">{{ $ticket->title }}</li>
            @empty
                <li class="list-group-item"> Not assigned.</li>
            @endforelse
        </ul>
        <h6><b>Description:</b></h6>
        <p >{{ $ticket->description }}</p>
        <br>
    </div>
@endsection
