<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_comment', 'comment_id', 'user_id');
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_comment', 'comment_id', 'profile_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    protected static function booted()
    {
        static::deleting(function ($comment) {
            UserComment::where('comment_id', $comment->id)->delete();

            ProfileComment::where('comment_id', $comment->id)->delete();
        });
    }
}
