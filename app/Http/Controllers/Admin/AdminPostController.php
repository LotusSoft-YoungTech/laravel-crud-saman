<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Restrict a post (Set is_public = false)
     */
    public function restrict($id)
    {
        $post = Post::findOrFail($id);
    
      
        $post->update(['is_public' => !$post->is_public ? 1 : 0]);
    
        return redirect()->route('admin.dashboard')->with('success', 'Post status updated successfully.');
    }
    /**
     * Delete a post
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Post deleted successfully.');
    }
}
