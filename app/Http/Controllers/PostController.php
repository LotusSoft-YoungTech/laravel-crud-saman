<?php

namespace App\Http\Controllers;
use App\Models\like;
use App\Models\comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostInteractionNotification;
use Mckenziearts\Notify\Facades\LaravelNotify;




class PostController extends Controller
{
    
    public function dashboard()
    {
        $user = Auth::user();
        $posts = Post::with('user')->latest()->paginate(10);
        $notifications = $user->unreadNotifications; 
    
        return view('post.dashboard', compact('posts', 'notifications'));
    }
    
    public function index()
    {
        $posts = Post::where('is_public', 1)->latest()->get(); 
        return view('post.view', compact('posts')); 
    }

    public function create()
    {
        return view('post.create');
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
        $user = Auth::user();
    
        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $id
            ]);
    
            // Notify the post owner
            if ($post->user_id !== $user->id) { 
                $post->user->notify(new PostInteractionNotification($user, $post, 'liked'));
            }
    
            
            LaravelNotify::success("You liked {$post->title}!", "Success");

        }
    
        return back();
    }
    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255'
        ]);
    
        $post = Post::findOrFail($id);
        $user = Auth::user();
    
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $id,
            'comment' => $request->comment
        ]);
    
        // Notify the post owner
        if ($post->user_id !== $user->id) {
            $post->user->notify(new PostInteractionNotification($user, $post, 'commented'));
        }
    
        return back();
    }
    public function show($id)
{
    // Find the post by ID
    $post = Post::with(['user', 'likes', 'comments.user'])->findOrFail($id);

    return view('post.show', compact('post'));
}
public function manage(){
    $posts = Post::where('user_id', Auth::id())->get();
    return view('post.manage', compact('posts'));
} public function edit($id)
{
    $post = Post::findOrFail($id);

    if ($post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    return view('post.edit', compact('post'));
}

public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    if ($post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string'
    ]);

    $post->update([
        'title' => $request->title,
        'content' => $request->content
    ]);

    return redirect()->route('manage')->with('success', 'Post updated successfully!');
}

public function destroy(Post $post)
{
    if ($post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $post->delete();
    return redirect()->route('manage')->with('success', 'Post deleted successfully.');
}
}