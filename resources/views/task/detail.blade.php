@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $task->title }}</h1>
                <hr class="my-2">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 mb-3 mb-lg-0 order-lg-2">
                @if(Auth::user() && \App\Enums\UserRole::manager(Auth::user()->role))
                    <a class="btn btn-success btn-block" href="/tasks/{{ $task->id }}/edit">Edit</a>
                    <form method="post" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success btn-block mt-1" >Delete</button>
                    </form>
                @endif
            </div>
            <div class="col mb-3 mb-lg-0 order-lg-1">
                <h6><b>State:</b> <span class="badge {{ \App\Enums\TicketStateToBootstrapBadge::Map[$task->state] }}">{{ \App\Enums\TaskTicketState::MapFrom[$task->state] }}</span></h6>
                <h6><b>Created:</b> {{ $task->created_at->format('G:i, j F y') }}</h6>
                <h6><b>Actualized:</b> {{ $task->updated_at->format('G:i, j F y') }}</h6>
                <h6><b>Assigned hours to fix:</b> {{ $task->allocated_hours }}</h6>
                <h6><b>Already spent hours:</b> {{ $task->spent_hours }}</h6>
                <h6><b>Managed by:</b> {{ $task->manager->login }}</h6>
            </div>
        </div>
        <h6><b>Assigned to employees:</b></h6>
        <ul class="list-group mb-2 ml-2">
            @forelse($task->employees as $employee)
                <li class="list-group-item">{{ $employee->login }}</li>
            @empty
                <li class="list-group-item"> Not assigned.</li>
            @endforelse
        </ul>
        <h6><b>Assigned to ticket:</b></h6>
        <ul class="list-group mb-2 ml-2">
            @forelse($task->tickets as $ticket)
                <li class="list-group-item">{{ $ticket->title }}</li>
            @empty
                <li class="list-group-item"> Not assigned.</li>
            @endforelse
        </ul>
        <h6><b>Description:</b></h6>
        <p class="ml-2 mt-0 mb-2 py-0">{{ $task->description }}</p>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card" id="comments">
                    <div class="card-body p-0">
                        <h3 class="mx-3 my-3 p-0">Solution state:</h3>
                        <div class="list-group m-2">
                            @foreach ($task->solutions as $solution)
                                <div class="list-group-item my-1">
                                    <h4 class="list-group-item-heading">{{ $solution->author->login }}</h4>
                                    <p class="info mb-0 mt-3 p-0"> {{ $solution->description }}</p>
                                </div>
                            @endforeach
                        </div>
                        @if(Auth::user() && $task->employees()->find(Auth::user()))
                            <div class="border p-2 m-2">
                                <h4>Update solution</h4>
                                <form method="POST" action="/solutions/{{ $task->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row mt-1 mb-1">
                                        <div class="col-2">Spent hours</div>
                                        <div class="col-2"><input name="hours" id="hours" class="form-control" type="number" value="1"/></div>
                                    </div>
                                    <div class="form-group m-0 mb-1 p-0">
                                        <textarea class="form-control" rows="2" id="solution" name="solution"
                                                  placeholder="Describe solution..."></textarea>
                                    </div>
                                    <div class="form-group m-0 p-0">
                                        <button type="submit" id="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
