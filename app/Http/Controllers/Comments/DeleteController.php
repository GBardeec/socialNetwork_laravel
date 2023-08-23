<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comment;
use App\Models\Profile;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __invoke(Profile $profile, Comment $comment)
    {
        $isProfileOwner = auth()->id() === $profile->user->id;

        if ($isProfileOwner || $comment->users->contains(auth()->user()) && $profile->comments->contains($comment)) {
            $comment->delete();
            return back();
        }

        return back()->with('error', 'Вы можете удалять только свои комментарии на этом профиле');
    }
}




