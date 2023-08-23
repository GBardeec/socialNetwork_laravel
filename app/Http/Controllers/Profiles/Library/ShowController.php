<?php

namespace App\Http\Controllers\Profiles\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke($profileId, Book $book)
    {
        $user = User::findOrFail($profileId);

        return view('library.show', compact('user', 'book'));
    }
}
