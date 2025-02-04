<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function dashboard()
    {
        $posts = Post::all();
        return view('post.dashboard', compact('posts'));
    }
    
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if (auth()->check()) {
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->user()->id, 
            ]);

            return redirect()->route('dashboard')->with('success', 'Post created successfully!');
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to create a post.');
        }
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
