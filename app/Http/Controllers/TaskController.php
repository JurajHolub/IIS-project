<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Task;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $request = request()->validate([
            'sort' => ['string']
        ]);

        if (!isset($request["sort"]) || $request["sort"] === "Newest")
        {
            $tasks = Task::orderBy('created_at', 'desc')->get();
            $sort = "newest";
        }
        elseif ($request["sort"] === "Oldest") {
            $task = Task::orderBy('created_at', 'asc')->get();
            $sort = "oldest";
        }
        else
        {
            $tasks = Task::orderBy('updated_at', 'desc')->get();
            $sort = "recently_updated";
        }

        return view('task.index', compact('tasks','sort'));
    }

    public function create()
    {
        $tasks = Task::all();
        $users = User::all();
        $tickets = Ticket::all();
        $employees = User::whereIn(
            'role', [UserRole::Employee, UserRole::Manager, UserRole::Director, UserRole::Admin])
            ->get();

        return view('task.create', compact('tasks', 'users', 'tickets', 'employees'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'ticket_id' => ['required'],
            'user_id' => ['required'],
            'allocated_hours' => ['required', 'integer'],
        ]);

        $task = new Task([
            'title' => $data['title'],
            'description' => $data['description'],
            'state' => \App\Enums\TaskTicketState::Open,
            'allocated_hours' => $data['allocated_hours'],
            'spent_hours' => 0,
            'manager_id' => Auth::id(),
        ]);

        $task->save();
        foreach ($data['ticket_id'] as $ticket)
        {
            $task->tickets()->attach($ticket);
        }
        foreach ($data['user_id'] as $employee)
        {
            $task->employees()->attach($employee);
        }

        return redirect('/tasks');
    }


}
