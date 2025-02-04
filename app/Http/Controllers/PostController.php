<?php

namespace App\Http\Controllers;
use App\Models\like;
use App\Models\comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('index', compact('posts')); 
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

    public function like($id)
    {
        $post = Post::findOrFail($id);
        if (!$post->likes()->where('user_id', Auth::id())->exists()) {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $id
            ]);
        }
        return back();
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255'
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'comment' => $request->comment
        ]);

        return back();
    }
    public function show($id)
{
    // Find the post by ID
    $post = Post::with(['user', 'likes', 'comments.user'])->findOrFail($id);

    return view('show', compact('post'));
}

}
