<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateRequest;
use App\Models\Book;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Book $book)
    {
        $book->title = $request->input('title');
        $book->content = $request->input('content');
        $book->update();

        return view('book.show', compact('book'));
    }
}
