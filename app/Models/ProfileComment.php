<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileComment extends Model
{
    use HasFactory;

    protected $table = 'profile_comment';
    protected $guarded = [];


    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }
}
