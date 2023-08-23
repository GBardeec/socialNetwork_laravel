<?php
namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;


class LinkAccessController extends Controller
{
    public function __invoke($profileId, $bookId)
    {
        $book = Book::findOrFail($bookId);

        $book->update([
            'link_accessible' => true,
        ]);

        return redirect()->back();
    }
}




