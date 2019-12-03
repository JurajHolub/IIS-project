<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Solution;
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

    public function show(Task $task)
    {
        return view('task.detail', compact('task'));
    }

    public function edit(Task $task)
    {
        $tickets = Ticket::all();
        $employees = User::whereIn(
            'role', [UserRole::Employee, UserRole::Manager, UserRole::Director, UserRole::Admin])
            ->get();
        return view('task.edit', compact('task', 'tickets', 'employees'));
    }

    public function solve(Task $task)
    {
        $data = request()->validate([
            'hours' => ['required', 'integer'],
            'solution' => ['required', 'string'],
        ]);

        $solution = new Solution([
            'description' => $data['solution'],
            'author_id' => Auth::id(),
            'task_id' => $task->id,
        ]);
        $solution->save();

        $task->update(['spent_hours' => $task->spent_hours + $data['hours']]);

        return redirect()->back();
    }

    public function update(Task $task)
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'state' => ['required', 'integer'],
            'allocated_hours' => ['required', 'integer'],
            'spent_hours' => ['required', 'integer'],
            'ticket_id' => ['required'],
            'user_id' => ['required'],
        ]);

        $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'state' => $data['state'],
            'allocated_hours' => $data['allocated_hours'],
            'spent_hours' => $data['spent_hours'],
            'ticket_id' => $data['ticket_id'],
            'user_id' => $data['user_id'],
        ]);

        $task->employees()->sync($data['user_id']);
        $task->tickets()->sync($data['ticket_id']);

        return redirect('/tasks/'.$task->id);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }

}
