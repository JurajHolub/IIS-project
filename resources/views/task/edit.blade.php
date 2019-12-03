@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
            <form method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" autocomplete="off"
                           value="{{ old('title', $task->title) }}">
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
                    <input name="allocated_hours" type="number" class="form-control @error('allocated_hours') is-invalid @enderror" id="allocated_hours" autocomplete="off"
                           value="{{ old('allocated_hours', $task->allocated_hours) }}">
                    @error('allocated_hours')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="spent_hours">Already spent hours</label>
                    <input name="spent_hours" type="number" class="form-control @error('spent_hours') is-invalid @enderror" id="spent_hours" autocomplete="off"
                           value="{{ old('spent_hours', $task->spent_hours) }}">
                    @error('spent_hours')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div>Related to tickets:</div>
                    <div class="border p-1 mt-2">
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
                </div>
                <div class="form-group">
                    <div>Assigned to employees:</div>
                    <div class="border p-1 mt-2">
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
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" id="description">{{ old('description',$task->description) }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submit" class="btn btn-success">Update task</button>
            </form>
    </div>
@endsection
