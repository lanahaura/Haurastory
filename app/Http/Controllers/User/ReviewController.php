<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(\App\Models\Book $book)
{
    $userId = auth()->id();

    $existing = \App\Models\Review::where('book_id', $book->id)
        ->where('user_id', $userId)
        ->first();

    $avgRating = (float) \App\Models\Review::where('book_id', $book->id)->avg('rating');
    $reviewsCount = (int) \App\Models\Review::where('book_id', $book->id)->count();

    $otherReviews = \App\Models\Review::with('user')
        ->where('book_id', $book->id)
        ->where('user_id', '!=', $userId)
        ->latest()
        ->paginate(5);

    return view('user.review', compact('book', 'existing', 'avgRating', 'reviewsCount', 'otherReviews'));
}

    public function store(\Illuminate\Http\Request $request, \App\Models\Book $book)
{
    $data = $request->validate([
        'rating'  => ['required', 'integer', 'min:1', 'max:5'],
        'comment' => ['nullable', 'string', 'max:1000'],
    ]);

    \App\Models\Review::updateOrCreate(
        ['user_id' => auth()->id(), 'book_id' => $book->id],
        ['rating' => $data['rating'], 'comment' => $data['comment']]
    );

    return redirect()
        ->route('books.review.create', $book)
        ->with('success', 'Ulasan berhasil disimpan ✨');
}
}

