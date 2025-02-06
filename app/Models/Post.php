<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
    'user_id',
    'title',
    'content',
    'is_public'
    ];
//post is by user for user os post belong to user
    public function user(){
        return $this->belongsTo(User::class);
    }
    //a post can have many like and comments one same post.
    public function likes(){
    return $this->hasMany(like::class);
    }
    public function comments(){
        return $this->hasMany(comment::class);
    }
}
