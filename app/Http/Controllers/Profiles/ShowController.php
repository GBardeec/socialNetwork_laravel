<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;


class ShowController extends Controller
{
    public function __invoke($id)
    {
        $user = User::find($id);
        $profile = $user->profile;

        $profileToShow = Profile::findOrFail($id);
        $profileComments = $profileToShow->comments;
        $profileCommentsCount = count($profileComments);

        return view('profile.index', compact('profile', 'profileToShow', 'profileComments', 'profileCommentsCount'));

    }


    public function loadMoreComments(Request $request, $profileId)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 5);

        $profile = Profile::findOrFail($profileId);
        $comments = $profile->comments()
            ->with(['users', 'parentComment'])
            ->offset($offset)
            ->limit($limit)
            ->get();

        foreach ($comments as $comment) {
            $comment->parent_content = $comment->parentComment ? $comment->parentComment->content : null;
            $comment->user = $comment->users;
        }

        return response()->json($comments);
    }

}
