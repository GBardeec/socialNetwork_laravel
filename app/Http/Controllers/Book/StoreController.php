<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;

use App\Http\Requests\Book\StoreRequest;
use App\Models\Book;
use App\Models\Library;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $book = new Book();
        $book->title = $request->input('title');
        $book->content = $request->input('content');
        $book->save();

        $user_id = $request->input('user_id');

       Library::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        return redirect()->route('book.index');
    }
}
