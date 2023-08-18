<?php

namespace App\Http\Controllers\UserComments;

use App\Http\Controllers\Controller;


class ShowController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $comments = $user->comments()->orderBy('created_at', 'desc')->get();

        return view('socialNetwork.comments', compact('comments'));
    }
}
