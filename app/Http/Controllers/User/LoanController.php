<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function borrow(Request $request, Book $book)
    {
        $user = $request->user();

        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis.');
        }

        // optional: cegah pinjam buku yang sama kalau masih dipinjam
        $stillBorrowed = Loan::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($stillBorrowed) {
            return back()->with('error', 'Buku ini masih kamu pinjam.');
        }

        DB::transaction(function () use ($user, $book) {
            Loan::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'borrowed_at' => Carbon::now()->toDateString(),
                'due_at' => Carbon::now()->addDays(7)->toDateString(), // bisa kamu ubah
                'status' => 'borrowed',
            ]);

            $book->decrement('stock', 1);
        });

        return back()->with('success', 'Berhasil meminjam buku.');
    }

    public function return(Request $request, Loan $loan)
    {
        $user = $request->user();

        if ($loan->user_id !== $user->id) abort(403);

        if ($loan->status === 'returned') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        if ($loan->status === 'pending_return') {
            return back()->with('error', 'Pengajuan pengembalian buku ini sedang menunggu konfirmasi.');
        }

        $loan->update([
            'status' => 'pending_return',
        ]);

        return back()->with('success', 'Pengajuan pengembalian berhasil dikirim! Menunggu konfirmasi admin.');
    }

    public function historyBorrows(Request $request)
    {
        $loans = Loan::with('book.category')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('user.history-borrows', compact('loans'));
    }

    public function historyReturns(Request $request)
    {
        $loans = Loan::with('book.category')
            ->where('user_id', $request->user()->id)
            ->whereIn('status', ['pending_return', 'returned'])
            ->latest()
            ->paginate(10);

        return view('user.history-returns', compact('loans'));
    }

    public function receipt(Request $request, Loan $loan)
{
    $user = $request->user();

    if ($loan->user_id !== $user->id) abort(403);

    $loan->load('book.category', 'user');

    return view('user.loan-receipt', compact('loan'));
}
}

