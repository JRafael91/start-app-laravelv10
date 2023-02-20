<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with('user','replies.user')
        ->orderBy('id', 'DESC')
        ->paginate();
        
        return view('dashboard',['comments' => $comments]);
    }
    
    public function store(Request $request)
    {
        $request->validate(['body' => 'required']);

        auth()->user()->comments()->create(['body' => $request->body]);

        return back();
    }
}
