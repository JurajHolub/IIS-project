<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class EditProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update() {
        $data = request()->validate([
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = request()->except('_token', "password_confirmation");
        $data = array_filter($data);
        \App\User::where('id', Auth::id())->update($data);
        return redirect()->back();
    }
}
