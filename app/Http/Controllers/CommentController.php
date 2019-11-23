<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'ticket_id' => ['required', 'numeric', 'integer'],
            'comment' => ['required', 'string'],
        ]);

        $ticket = new Comment([
            'title' => "naco je tu tento chlievik?",
            'description' => $data['comment'],
            'author_id' => Auth::id(),
            'ticket_id' => $data['ticket_id'],
        ]);

        $ticket->save();
        return redirect('/tickets/'.$data['ticket_id']."#comment");
    }
}
