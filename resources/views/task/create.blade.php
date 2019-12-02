@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <form method="POST" action="/tasks">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Enter title" autocomplete="off">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state">
                    <option value="{{ \App\Enums\TaskTicketState::Open }}">Open</option>
                    <option value="{{ \App\Enums\TaskTicketState::Pending }}">Pending</option>
                    <option value="{{ \App\Enums\TaskTicketState::Resolved }}">Resolved</option>
                    <option value="{{ \App\Enums\TaskTicketState::Closed }}">Closed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="allocated_hours" >Number of assigned hours</label>
                <div >
                    <input class="form-control" type="number" value="1" id="allocated_hours" name="allocated_hours">
                </div>
            </div>
            <h6>Assigned to employees:</h6>
            <div class="border">
                @foreach ($employees as $employee)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="user_id[]" value="{{ $employee->id }}"/>
                        <label class="form-check-label" for="user_id[]">
                            {{ $employee->login }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="5" id="description" placeholder="Describe task..."></textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" id="submit" class="btn btn-success">Create task</button>
        </form>
    </div>
@endsection
