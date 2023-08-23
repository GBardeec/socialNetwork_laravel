<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $books = Book::whereHas('libraries', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('book.index', compact('books', 'user'));
    }
}
