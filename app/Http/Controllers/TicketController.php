<?php

namespace App\Http\Controllers;

use App\ProductPart;
use App\Ticket;
use App\Product;
use App\TicketProductPart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search()
    {
        $request = request()->validate([
            'ticket' => ['string'],
            'product' => ['string'],
            'author' => ['string'],
            'state' => ['string'],
        ]);

        //TODO search queryes

        return $this->index();
    }

    public function index()
    {
        $request = request()->validate([
            'sort' => ['string']
        ]);

        if (!isset($request["sort"]) || $request["sort"] === "Recently updated")
        {
            $tickets = Ticket::all()
                ->sortByDesc(function ($ticket) {
                    $recentComment = $ticket->comments->sortByDesc('created_at')->first();
                    if (!$recentComment) {
                        return $ticket->created_at;
                    }
                    return $recentComment->created_at->max($ticket->created_at);
                });
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
            $tickets = Ticket::all()
                ->sortByDesc(function ($ticket) {
                    return $ticket->comments->count();
                });

            $sort = "most_commented";
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
        $products = Product::get();
        return view('ticket.create', compact('products'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'numeric', 'integer'],
            'product_part_id' => ['required'],
            'image' => ['nullable', 'image'],
        ]);

        $ticket = new Ticket([
            'title' => $data['title'],
            'description' => $data['description'],
            'state' => 'open',
            'priority' => $data['priority'],
            'author_id' => Auth::id(),
        ]);
        $ticket->save();
        foreach ($data['product_part_id'] as $part)
        {
            $ticket->product_parts()->attach(ProductPart::find([$part]));
        }

        return redirect('/tickets/'.$ticket->id);
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('ticket.detail', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $product_parts = ProductPart::all();
        return view('ticket.edit', compact('ticket', 'product_parts'));
    }

    public function update(Ticket $ticket)
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'state' => ['required', 'integer'],
            'product_part_id' => ['required'],
        ]);

        $ticket->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'state' => $data['state'],
        ]);

        $ticket->product_parts()->sync($data['product_part_id']);

        return redirect('/tickets');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->comments()->delete();
        $ticket->delete();
        return redirect('/tickets');
    }
}
