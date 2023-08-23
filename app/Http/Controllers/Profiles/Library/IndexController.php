<?php

namespace App\Http\Controllers\Profiles\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke($profile)
    {
        $user = User::findOrFail($profile);

        $books = Book::whereHas('libraries', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('library.index', compact('user', 'books'));
    }
}

