<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comment;
use App\Http\Requests\ReplyCommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommentReplyController extends Controller
{
    public function __invoke(ReplyCommentRequest $request, Comment $parentComment)
    {
        $reply = new Comment();
        $reply->title = $request->input('title');
        $reply->content = $request->input('content');
        $reply->parent_comment_id = $parentComment->id;

        $user = Auth::user();
        $user->comments()->save($reply);


        $parentProfile = $parentComment->profiles()->first();

        if ($parentProfile) {
            $reply->profiles()->attach($parentProfile->id);
        }

        return redirect()->back();
    }
}

