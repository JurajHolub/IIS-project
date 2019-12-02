@extends('layouts.app')

@section ('title', 'Users')

@section('content')
    <div class="container">
        <div class="border p-1 mb-5">
            <form method="post" action="{{ $user->id }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="login">Login</label>
                    <input name="login" type="text" class="form-control" id="login" autocomplete="off"
                           value="{{ $user->login }}">
                    @error('login')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" autocomplete="off"
                           value="{{ $user->email }}">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" autocomplete="off"
                           value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input name="surname" type="text" class="form-control" id="surname" autocomplete="off"
                           value="{{ $user->surname }}">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option>Admin</option>
                        <option>Director</option>
                        <option>Manager</option>
                        <option>Employee</option>
                        <option>Customer</option>
                        @foreach(\App\Enums\UserRole::MapFrom as $role)
                            <option value="{{ \App\Enums\UserRole::MapTo[$role]}}"
                                    @if($user->role === \App\Enums\UserRole::MapTo[$role])
                                    selected
                                @endif
                            >{{ $role }}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <h6><b>Created:</b> {{ $user->created_at }}</h6>
                <h6><b>Last actualized:</b> {{ $user->updated_at }}</h6>
                <button type="submit" id="submit" class="btn btn-success">Update user</button>
            </form>
        </div>
        <div class="border p-1">
            <h2> Change password</h2>
            <form>
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="password0">Enter old password</label>
                    <input name="password0" type="password" class="form-control" id="password0" autocomplete="off" value="">
                    <label for="password0">Enter new password</label>
                    <input name="password1" type="password" class="form-control" id="password1" autocomplete="off" value="">
                    <label for="password0">Reenter new password</label>
                    <input name="password0" type="password" class="form-control" id="password0" autocomplete="off" value="">
                </div>
                <button type="submit" id="submit" class="btn btn-success">Update password</button>
            </form>
        </div>
    </div>
@endsection
