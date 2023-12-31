<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;

class DeleteController extends Controller
{
    public function __invoke(Book $book)
    {
        $book -> delete();
        return redirect()->route('book.index');
    }
}
