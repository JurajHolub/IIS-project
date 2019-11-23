<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
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

        if (!isset($request["sort"]) || $request["sort"] === "Recently updated")
        {
            $tickets = Ticket::orderBy('updated_at', 'desc')->get();
            $sort = "recently_updated";
        }
        elseif($request["sort"] === "Oldest") {
            $tickets = Ticket::orderBy('created_at', 'asc')->get();
            $sort = "oldest";
        }
        elseif ($request["sort"] === "Newest") {
            $tickets = Ticket::orderBy('created_at', 'desc')->get();
            $sort = "newest";
        }
        elseif ($request["sort"] === "Most commented")
        {
            $tickets = Ticket::orderBy('updated_at', 'desc')->get();
            $sort = "recently_updated";
        }
        elseif ($request["sort"] === "Least Commented")
        {
            $tickets = Ticket::orderBy('updated_at', 'desc')->get();
            $sort = "recently_updated";
        }
        else
        {
            $tickets = Ticket::orderBy('updated_at', 'desc')->get();
            $sort = "recently_updated";
        }


        return view('ticket.index', compact('tickets','sort'));
    }

    public function create()
    {
        return view('ticket.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'numeric', 'integer'],
            'image' => ['nullable', 'image']
        ]);

        $ticket = new Ticket([
            'title' => $data['title'],
            'description' => $data['description'],
            'state' => 'open',
            'priority' => $data['priority'],
            'author_id' => Auth::id(),
        ]);

        $ticket->save();

        return redirect('/tickets/'.$ticket->id);
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('ticket.detail', compact('ticket'));
    }
}
