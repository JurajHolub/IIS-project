<?php

namespace App\Http\Controllers;

use App\Rules\MatchPassword;
use App\User;
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

    public function index()
    {
        $request = request()->validate([
            'sort' => ['string']
        ]);

        if (!isset($request["sort"]) || $request["sort"] === "Newest")
        {
            $users = User::orderBy('created_at', 'desc')->get();
            $sort = "newest";
        }
        elseif ($request["sort"] === "Oldest") {
            $users = User::orderBy('created_at', 'asc')->get();
            $sort = "oldest";
        }
        else
        {
            $users = User::orderBy('updated_at', 'desc')->get();
            $sort = "recently_updated";
        }

        return view('user.index', compact('users','sort'));
    }

    public function show(\App\User $user)
    {
        return view('user.detail', compact('user'));
    }

    public function edit(\App\User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function profile(\App\User $user)
    {
        return view('user.profile', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        $data = request()->validate([
            'login' => ['required', 'string', Rule::unique('users')->ignore(Auth::id())],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'required_with:password_confirmation', 'same:password_confirmation'], // TODO verify
            'password_confirmation' => ['required', 'string'],
            'role' => ['required'], //TODO check if enum
        ]);


        $product = new \App\User([
            'login' => $data['login'],
            'email' => $data['email'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => \App\Enums\UserRole::MapTo[$data['role']],
        ]);

        $product->save();

        return redirect('/users');
    }

    public function updateuser(\App\User $user)
    {
        $data = request()->validate([
            'login' => ['required', 'string', Rule::unique('users')->ignore(Auth::id())],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update([
            'login' => $data['login'],
            'email' => $data['email'],
            'name' => $data['name'],
            'surname' => $data['surname'],
        ]);

        return view('/home');
    }

    public function updatepasswd(\App\User $user)
    {
        $data = request()->validate([
            'password-old' => ['required', 'string', 'max:255', new MatchPassword],
            'password' => ['required', 'string', 'required_with:password_confirmation', 'same:password_confirmation'], // TODO verify
            'password_confirmation' => ['required', 'string'],
        ]);

        $user->update([
            'password' => Hash::make(request("password")),
        ]);

        return view('/home');
    }

    public function updateAdmin(\App\User $user)
    {
        $data = request()->validate([
            'login' => ['required', 'string', Rule::unique('users')->ignore(Auth::id())],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'role' => ['required']
        ]);

        $user->update([
            'login' => $data['login'],
            'email' => $data['email'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'role' => \App\Enums\UserRole::MapTo[$data['role']],
        ]);

        return view('user.edit', compact('user'));

        //update everthing except password
        \App\User::where('id', Auth::id())->update($data);

        //update password
        if (!is_null(request("password"))) {
            \App\User::where('id', Auth::id())
                ->update([
                    'password' => Hash::make(request("password")),
                    ]);
        }
        return redirect()->back();
    }

    public function destroyAdmin(\App\User $user)
    {
        $user->delete();

        return redirect('/users');
    }

    public function destroyUser(\App\User $user)
    {
        $user->delete();

        return redirect('/home');
    }
}
