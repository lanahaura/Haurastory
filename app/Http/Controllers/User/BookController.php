<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Book::with('category');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
        });
    }

    $books = $query->latest()->paginate(8)->withQueryString();

    $returnedBookIds = \App\Models\Loan::where('user_id', auth()->id())
        ->where('status', 'returned')
        ->pluck('book_id')
        ->toArray();

    return view('user.dashboard', compact('books', 'returnedBookIds'));
}
}
