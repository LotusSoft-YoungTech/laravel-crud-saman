<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\PostInteractionNotification;

class AdminPostController extends Controller
{
    /**
     * Restrict a post (Set is_public = false)
     */
    public function restrict($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['is_public' => !$post->is_public]);
    
        // Notify the post owner
        $post->user->notify(new PostInteractionNotification(auth()->user(), $post, 'restricted'));
    
        return redirect()->route('admin.dashboard')->with('success', 'Post status updated successfully.');
    }
    /**
     * Delete a post
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $user = $post->user; // Store user before deleting the post
        $post->delete();
    
        // Notify the post owner
        $user->notify(new PostInteractionNotification(auth()->user(), $post, 'deleted'));
    
        return redirect()->route('admin.dashboard')->with('success', 'Post deleted successfully.');
    }
}
