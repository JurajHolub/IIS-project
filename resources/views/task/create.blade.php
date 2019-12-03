@extends('layouts.app')

@section ('title', 'Tasks')

@section('content')
    <div class="container">
        <form method="POST" action="../tasks">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title" autocomplete="off" value="{{ old('title') }}">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="allocated_hours" >Number of assigned hours</label>
                <div >
                    <input class="form-control @error('allocated_hours') is-invalid @enderror" type="number" value="{{ old('allocated_hours', 1) }}" id="allocated_hours" name="allocated_hours">
                    @error('allocated_hours')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div>Assigned to employees:</div>
                <div class="border p-1 mt-2">
                @foreach ($employees as $employee)
                    <div class="form-check ml-2">
                        <input class="form-check-input" type="checkbox" name="user_id[]" value="{{ $employee->id }}"
                               @if(is_array(old('user_id')) && in_array($employee->id, old('user_id'))) checked @endif/>
                        <label class="form-check-label" for="user_id[]">
                            {{ $employee->login }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('user_id')
            <div class="alert alert-danger">Please select product</div>
            @enderror
            </div>
            <div class="form-group">
                <div>Related to tickets:</div>
                <div class="border p-1 mt-2">
                @foreach ($tickets as $ticket)
                    <div class="form-check ml-2">
                        <input class="form-check-input" type="checkbox" name="ticket_id[]" value="{{ $ticket->id }}"
                               @if(is_array(old('ticket_id')) && in_array($employee->id, old('ticket_id'))) checked @endif/>
                        <label class="form-check-label" for="ticket_id[]">
                            {{ $ticket->title }}
                        </label>
                    </div>
                @endforeach
                </div>
                @error('ticket_id')
                <div class="alert alert-danger">Please select product</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @ @error('description') is-invalid @enderror" rows="5" id="description" placeholder="Describe task...">{{ old('description') }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" id="submit" class="btn btn-success">Create task</button>
        </form>
    </div>
@endsection
