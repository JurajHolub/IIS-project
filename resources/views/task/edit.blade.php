@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="border p-1">
            <form method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" autocomplete="off"
                           value="{{ $task->title }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <select class="form-control" id="state" name="state">
                        @foreach(\App\Enums\TaskTicketState::MapFrom as $state)
                            <option value="{{ \App\Enums\TaskTicketState::MapTo[$state]}}"
                            @if($task->state === \App\Enums\TaskTicketState::MapTo[$state])
                                selected
                            @endif
                            >{{ $state }}</option>
                        @endforeach
                    </select>
                    @error('state')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="allocated_hours">Assigned hours to fix</label>
                    <input name="allocated_hours" type="number" class="form-control" id="allocated_hours" autocomplete="off"
                           value="{{ $task->allocated_hours }}">
                    @error('allocated_hours')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="spent_hours">Already spent hours</label>
                    <input name="spent_hours" type="number" class="form-control" id="spent_hours" autocomplete="off"
                           value="{{ $task->spent_hours }}">
                    @error('spent_hours')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <h6><b>Managed by:</b> {{ $task->manager->login }}</h6>
                <h6>Assigned to tickets:</h6>
                <div class="border">
                    @foreach ($tickets as $ticket)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ticket_id[]" value="{{ $ticket->id }}"
                            @if($ticket->tasks->contains($task))
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="ticket_id[]">
                                {{ $ticket->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <h6>Assigned to employees:</h6>
                <div class="border">
                    @foreach ($employees as $employee)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="user_id[]" value="{{ $employee->id }}"
                            @if($employee->tasks->contains($task))
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="user_id[]">
                                {{ $employee->login }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <h6><b>Created:</b> {{ $task->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $task->updated_at }}</h6>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="5" id="description">{{ $task->description }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submit" class="btn btn-success">Update task</button>
            </form>
        </div>
    </div>
@endsection
