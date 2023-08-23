<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('book.create');
    }
}
