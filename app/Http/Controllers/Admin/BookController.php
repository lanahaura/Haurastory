<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index() {
    $books = Book::with('category')->latest()->paginate(10);
    return view('admin.books.index', compact('books'));
}


    public function create() {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'category_id' => ['required','exists:categories,id'],
            'title' => ['required','string','max:255'],
            'author' => ['required','string','max:255'],
            'publisher' => ['required','string','max:255'],
            'published_year' => ['required','integer','min:1900','max:'.date('Y')],
            'stock' => ['required','integer','min:0'],
            'cover' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],

        ]);

        if ($request->hasFile('cover')) {
        $data['cover'] = $request->file('cover')->store('covers', 'public');
    }
        Book::create($data);
        return redirect()->route('admin.books.index')->with('success','Buku ditambahkan.');
    }

    public function edit(Book $book) {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book','categories'));
    }

    public function update(Request $request, Book $book) {
        $data = $request->validate([
            'category_id' => ['required','exists:categories,id'],
            'title' => ['required','string','max:255'],
            'author' => ['required','string','max:255'],
            'publisher' => ['required','string','max:255'],
            'published_year' => ['required','integer','min:1900','max:'.date('Y')],
            'stock' => ['required','integer','min:0'],
            'cover' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],

        ]);

        if ($request->hasFile('cover')) {
        // hapus cover lama jika ada
        if ($book->cover && \Storage::disk('public')->exists($book->cover)) {
        \Storage::disk('public')->delete($book->cover);
        }
        $data['cover'] = $request->file('cover')->store('covers', 'public');
    }
        $book->update($data);
        return redirect()->route('admin.books.index')->with('success','Buku diperbarui.');
    }

    public function destroy(Book $book) {
        $book->delete();
        return back()->with('success','Buku dihapus.');
    }
}
