<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comment;
use App\Models\Profile;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateCommentRequest;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke(CreateCommentRequest  $request, $profileId)
    {
        $comment = new Comment();
        $comment->title = $request->input('title');
        $comment->content = $request->input('content');
        $comment->save();

        $user = Auth::user();
        $user->comments()->attach($comment->id);

        $profile = Profile::findOrFail($profileId);
        $profile->comments()->attach($comment->id);

        return redirect()->back();
    }
}

