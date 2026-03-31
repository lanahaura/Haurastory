<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user','book.category'])
            ->whereIn('status', ['pending_borrow', 'borrowed', 'rejected_borrow'])
            ->latest()
            ->paginate(10);

        return view('admin.loans.index', compact('loans'));
    }

    public function approveBorrow(Loan $loan)
    {
        if ($loan->status !== 'pending_borrow') {
            return back()->with('error', 'Status peminjaman tidak valid untuk disetujui.');
        }

        if ($loan->book->stock < 1) {
            return back()->with('error', 'Stok buku habis, tidak bisa disetujui.');
        }

        $loan->update(['status' => 'borrowed']);
        $loan->book()->decrement('stock', 1);

        return back()->with('success', 'Peminjaman berhasil disetujui, stok buku telah dikurangi.');
    }

    public function rejectBorrow(Loan $loan)
    {
        if ($loan->status !== 'pending_borrow') {
            return back()->with('error', 'Status peminjaman tidak valid untuk ditolak.');
        }

        $loan->update(['status' => 'rejected_borrow']);

        return back()->with('success', 'Peminjaman telah ditolak.');
    }

    public function returns()
    {
        $loans = Loan::with(['user','book.category'])
            ->whereIn('status', ['pending_return', 'returned'])
            ->latest('returned_at')
            ->latest() // fallback for pending_return which might not have returned_at yet
            ->paginate(10);

        return view('admin.returns.index', compact('loans'));
    }

    public function approveReturn(Loan $loan)
    {
        if ($loan->status !== 'pending_return') {
            return back()->with('error', 'Status pengembalian tidak valid untuk disetujui.');
        }

        $loan->update([
            'status' => 'returned',
            'returned_at' => now()->toDateString(),
        ]);
        $loan->book()->increment('stock', 1);

        return back()->with('success', 'Pengembalian berhasil disetujui, stok buku telah dikembalikan.');
    }

    public function rejectReturn(Loan $loan)
    {
        if ($loan->status !== 'pending_return') {
            return back()->with('error', 'Status pengembalian tidak valid untuk ditolak.');
        }

        $loan->update(['status' => 'borrowed']);

        return back()->with('success', 'Pengajuan pengembalian telah ditolak, status buku kembali ke Dipinjam.');
    }
}

