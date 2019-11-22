<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
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
}
