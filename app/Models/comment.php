<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Add 'user_id' to the $fillable array
    protected $fillable = [
        'user_id',   // Add this to allow mass assignment for user_id
        'post_id',
        'comment',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

