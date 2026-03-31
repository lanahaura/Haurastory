<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function create(Book $book)
    {
        // kalau stok habis, tetap boleh tampilkan form tapi tombol submit bisa disable
        return view('user.borrow.create', compact('book'));
    }

    public function store(Request $request, Book $book)
{
    $data = $request->validate([
        'borrower_name' => 'required|string|max:100',
        'borrower_phone' => 'required|string|max:20',
        'borrowed_at' => 'required|date',
        'due_at' => 'required|date|after_or_equal:borrowed_at',
    ]);

    // Validasi: User tidak bisa meminjam buku yang sama jika statusnya masih pending_borrow, borrowed, atau pending_return
    $stillBorrowed = Loan::where('user_id', auth()->id())
        ->where('book_id', $book->id)
        ->whereIn('status', ['pending_borrow', 'borrowed', 'pending_return'])
        ->exists();

    if ($stillBorrowed) {
        return back()->with('error', 'Kamu masih memiliki transaksi peminjaman aktif untuk buku ini!');
    }

    if ($book->stock < 1) {
        return back()->with('error', 'Stok habis!');
    }

    Loan::create([
        'user_id' => auth()->id(),
        'book_id' => $book->id,
        'borrower_name' => $data['borrower_name'],
        'borrower_phone' => $data['borrower_phone'],
        'borrowed_at' => $data['borrowed_at'],
        'due_at' => $data['due_at'],
        'status' => 'pending_borrow', // User mengajukan, tunggu admin
    ]);

    // Stok TIDAK dikurangi di sini, stok dikurangi saat Admin menyetujui

    return redirect()->route('history.borrows')->with('success', 'Pengajuan peminjaman berhasil dikirim! Menunggu konfirmasi admin.');
}

}
