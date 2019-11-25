@extends('layouts.app')

@section ('title', 'Users')

@section('content')
    <div class="container">
        <form method="post" action="/users">
            @csrf
            <div class="form-group">
                <label for="login">Login</label>
                <input name="login" type="text" class="form-control" id="login" autocomplete="off">
                @error('login')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Priority</label>
                <select class="form-control" id="role" name="role">
                    <option>Admin</option>
                    <option>Director</option>
                    <option>Manager</option>
                    <option>Employee</option>
                    <option>Customer</option>
                </select>
                @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" autocomplete="off">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input name="surname" type="text" class="form-control" id="surname" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Enter password</label>
                <input name="password" type="password" class="form-control" id="password" autocomplete="off" value="">
                <label for="password_confirmation">Reenter password</label>
                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" autocomplete="off" value="">
            </div>
            <button type="submit" id="submit" class="btn btn-success">Create user</button>
        </form>
    </div>
@endsection
