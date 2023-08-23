<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;

class EditController extends Controller
{
    public function __invoke(Book $book)
    {
        return view('book.edit', compact('book'));
    }
}
