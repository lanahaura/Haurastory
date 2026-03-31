<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->query('from');
        $to   = $request->query('to');

        $q = Loan::with(['user','book.category']);

        if ($from) $q->whereDate('borrowed_at', '>=', $from);
        if ($to)   $q->whereDate('borrowed_at', '<=', $to);

        $rows = $q->latest()->paginate(10);

        $summary = [
            'total' => (clone $q)->count(),
            'borrowed' => (clone $q)->where('status','borrowed')->count(),
            'returned' => (clone $q)->where('status','returned')->count(),
        ];

        return view('admin.reports.index', compact('rows','summary','from','to'));

    }

        public function pdf(Request $request)
{
    $from = $request->query('from');
    $to   = $request->query('to');

    $q = Loan::with(['user','book.category']);

    if ($from) $q->whereDate('borrowed_at', '>=', $from);
    if ($to)   $q->whereDate('borrowed_at', '<=', $to);

    $rows = $q->latest()->get(); // untuk PDF ambil semua (tanpa paginate)

    $summary = [
        'total' => (clone $q)->count(),
        'borrowed' => (clone $q)->where('status','borrowed')->count(),
        'returned' => (clone $q)->where('status','returned')->count(),
    ];

    $pdf = Pdf::loadView('admin.reports.pdf', compact('rows','summary','from','to'))
        ->setPaper('a4', 'portrait');

    $filename = 'laporan_peminjaman_' . now()->format('Ymd_His') . '.pdf';

    return $pdf->download($filename);
}

    }
